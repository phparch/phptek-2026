<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GiveawayEligibility
{
    private ?Collection $requiredVendorSlugs = null;

    /** @var Collection<string, Collection<int, string>>|null */
    private ?Collection $interactionsByAttendee = null;

    private ?Collection $eligibleBadgeUuids = null;

    /** @var array<string, string>|null */
    private ?array $sponsorNamesBySlug = null;

    private bool $conferenceDatesResolved = false;

    /** @var array{0: string, 1: string}|null */
    private ?array $conferenceDates = null;

    /**
     * @return Collection<int, string>
     */
    public function requiredVendorSlugs(): Collection
    {
        if ($this->requiredVendorSlugs !== null) {
            return $this->requiredVendorSlugs;
        }

        $conferenceUuid = $this->currentConferenceUuid();

        if ($conferenceUuid === null) {
            return $this->requiredVendorSlugs = collect();
        }

        $slugs = DB::connection('phptek_tv')
            ->table('sponsors as s')
            ->join('conference_sponsor as cs', 'cs.sponsor_uuid', '=', 's.uuid')
            ->where('cs.conference_uuid', $conferenceUuid)
            ->where('cs.skip_for_giveaway', 0)
            ->whereNotNull('s.slug')
            ->pluck('s.slug');

        return $this->requiredVendorSlugs = $slugs->unique()->values();
    }

    /**
     * @return Collection<string, Collection<int, string>>
     */
    public function interactionsByAttendee(): Collection
    {
        if ($this->interactionsByAttendee !== null) {
            return $this->interactionsByAttendee;
        }

        $dates = $this->currentConferenceDates();

        $shareIntents = DB::connection('mobile_app')
            ->table('share_intents')
            ->where('target_type', 'vendor')
            ->whereNotNull('source_badge_uuid')
            ->whereNotNull('target_id')
            ->when($dates, fn ($q) => $q->whereBetween('created_at', $dates))
            ->select(['source_badge_uuid as badge_uuid', 'target_id as slug'])
            ->get();

        $vendorContacts = DB::connection('mobile_app')
            ->table('vendor_contacts')
            ->whereNull('deleted_at')
            ->whereNotNull('badge_uuid')
            ->whereNotNull('vendor_id')
            ->when($dates, fn ($q) => $q->whereBetween('scanned_at', $dates))
            ->select(['badge_uuid', 'vendor_id as slug'])
            ->get();

        $merged = $shareIntents->concat($vendorContacts);

        return $this->interactionsByAttendee = $merged
            ->groupBy('badge_uuid')
            ->map(fn (Collection $rows): Collection => $rows->pluck('slug')->unique()->values());
    }

    /**
     * @return Collection<int, string>
     */
    public function eligibleBadgeUuids(): Collection
    {
        if ($this->eligibleBadgeUuids !== null) {
            return $this->eligibleBadgeUuids;
        }

        $required = $this->requiredVendorSlugs();

        if ($required->isEmpty()) {
            return $this->eligibleBadgeUuids = collect();
        }

        $threshold = $this->demoMinMatches() ?? $required->count();

        $eligible = $this->interactionsByAttendee()
            ->filter(fn (Collection $slugs): bool => $required->intersect($slugs)->count() >= $threshold)
            ->keys()
            ->values();

        return $this->eligibleBadgeUuids = $eligible;
    }

    /**
     * @return Collection<int, array{badge_uuid: string, name: ?string}>
     */
    public function eligibleAttendees(): Collection
    {
        $uuids = $this->eligibleBadgeUuids();

        if ($uuids->isEmpty()) {
            return collect();
        }

        $users = DB::connection('phptek_tv')
            ->table('users')
            ->whereIn('uuid', $uuids->all())
            ->select(['uuid', 'first_name', 'last_name'])
            ->get()
            ->keyBy('uuid');

        return $uuids
            ->map(function (string $uuid) use ($users): array {
                $user = $users->get($uuid);
                $name = $user ? trim(trim((string) $user->first_name).' '.trim((string) $user->last_name)) : '';

                return [
                    'badge_uuid' => $uuid,
                    'name' => $name !== '' ? $name : null,
                ];
            })
            ->values();
    }

    /**
     * @return Collection<int, string>
     */
    public function missingVendorsFor(string $badgeUuid): Collection
    {
        $required = $this->requiredVendorSlugs();
        $theirs = $this->interactionsByAttendee()->get($badgeUuid, collect());

        return $required->diff($theirs)->values();
    }

    /**
     * @return array<string, string>
     */
    public function sponsorNamesBySlug(): array
    {
        if ($this->sponsorNamesBySlug !== null) {
            return $this->sponsorNamesBySlug;
        }

        return $this->sponsorNamesBySlug = DB::connection('phptek_tv')
            ->table('sponsors')
            ->whereNotNull('slug')
            ->select(['slug', 'name'])
            ->get()
            ->pluck('name', 'slug')
            ->all();
    }

    /**
     * @return array{
     *     user_uuid: string,
     *     email: string,
     *     qualified: bool,
     *     required_count: int,
     *     scanned_count: int,
     *     rows: array<int, array{slug: string, name: string, scanned: bool}>
     * }
     */
    public function statusForEmail(string $email): array
    {
        $userUuid = $this->userUuidByEmail($email);
        $required = $this->requiredVendorSlugs();
        $names = $this->sponsorNamesBySlug();

        if ($required->isEmpty()) {
            return [
                'user_uuid' => $userUuid,
                'email' => $email,
                'qualified' => false,
                'required_count' => 0,
                'scanned_count' => 0,
                'rows' => [],
            ];
        }

        $isUnknown = $userUuid === 'uuid-not-found';

        if ($isUnknown) {
            $count = $required->count();
            $scannedCount = $count >= 2 ? random_int(1, $count - 1) : 0;
            $scannedSlugs = $required->shuffle()->take($scannedCount);
        } else {
            $scannedSlugs = $this->interactionsForUuid($userUuid);
        }

        $rows = $required->map(fn (string $slug): array => [
            'slug' => $slug,
            'name' => $names[$slug] ?? $slug,
            'scanned' => $scannedSlugs->contains($slug),
        ])->all();

        $scannedCount = collect($rows)->where('scanned', true)->count();
        $qualified = ! $isUnknown && $scannedCount === $required->count();

        return [
            'user_uuid' => $userUuid,
            'email' => $email,
            'qualified' => $qualified,
            'required_count' => $required->count(),
            'scanned_count' => $scannedCount,
            'rows' => $rows,
        ];
    }

    private function userUuidByEmail(string $email): string
    {
        $uuid = DB::connection('phptek_tv')
            ->table('users')
            ->where('email', $email)
            ->value('uuid');

        return $uuid ?: 'uuid-not-found';
    }

    /**
     * @return Collection<int, string>
     */
    private function interactionsForUuid(string $uuid): Collection
    {
        $dates = $this->currentConferenceDates();

        $shareIntents = DB::connection('mobile_app')
            ->table('share_intents')
            ->where('source_badge_uuid', $uuid)
            ->where('target_type', 'vendor')
            ->whereNotNull('target_id')
            ->when($dates, fn ($q) => $q->whereBetween('created_at', $dates))
            ->pluck('target_id');

        $vendorContacts = DB::connection('mobile_app')
            ->table('vendor_contacts')
            ->whereNull('deleted_at')
            ->where('badge_uuid', $uuid)
            ->whereNotNull('vendor_id')
            ->when($dates, fn ($q) => $q->whereBetween('scanned_at', $dates))
            ->pluck('vendor_id');

        return $shareIntents->concat($vendorContacts)->unique()->values();
    }

    /**
     * @return array{0: string, 1: string}|null
     */
    private function currentConferenceDates(): ?array
    {
        if ($this->conferenceDatesResolved) {
            return $this->conferenceDates;
        }

        $this->conferenceDatesResolved = true;
        $uuid = $this->currentConferenceUuid();

        if ($uuid === null) {
            return $this->conferenceDates = null;
        }

        $row = DB::connection('phptek_tv')
            ->table('conferences')
            ->where('uuid', $uuid)
            ->select(['start_date', 'end_date'])
            ->first();

        if (! $row || ! $row->start_date || ! $row->end_date) {
            return $this->conferenceDates = null;
        }

        return $this->conferenceDates = [(string) $row->start_date, (string) $row->end_date];
    }

    private function demoMinMatches(): ?int
    {
        $raw = config('tek.giveaway.demo_min_matches');

        if ($raw === null || $raw === '') {
            return null;
        }

        $value = (int) $raw;

        return $value > 0 ? $value : null;
    }

    private function currentConferenceUuid(): ?string
    {
        $uuid = config('tek.conference.uuid');

        return ! empty($uuid) ? (string) $uuid : null;
    }
}
