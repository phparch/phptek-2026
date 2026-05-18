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

        $shareIntents = DB::connection('mobile_app')
            ->table('share_intents')
            ->where('target_type', 'vendor')
            ->whereNotNull('source_badge_uuid')
            ->whereNotNull('target_id')
            ->select(['source_badge_uuid as badge_uuid', 'target_id as slug'])
            ->get();

        $vendorContacts = DB::connection('mobile_app')
            ->table('vendor_contacts')
            ->whereNull('deleted_at')
            ->whereNotNull('badge_uuid')
            ->whereNotNull('vendor_id')
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
