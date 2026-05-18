<?php

namespace App\Console\Commands;

use App\Services\GiveawayEligibility;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SeedGiveawayDemoCommand extends Command
{
    protected $signature = 'giveaway:seed-demo
        {--count=20 : Number of fake attendees to seed (ignored with --clear)}
        {--matches= : How many required vendors each attendee should hit (default: all)}
        {--clear : Remove all rows inserted by previous demo seeds}';

    protected $description = 'Seed fake share_intents rows so /giveaway has data to demo (non-production only)';

    private const TRACKING_FILE = 'giveaway-demo-seeded.json';

    public function handle(GiveawayEligibility $eligibility): int
    {
        if (app()->environment('production')) {
            $this->error('Refusing to run in the production environment.');

            return self::FAILURE;
        }

        return $this->option('clear')
            ? $this->clear()
            : $this->seed($eligibility);
    }

    private function seed(GiveawayEligibility $eligibility): int
    {
        $required = $eligibility->requiredVendorSlugs();

        if ($required->isEmpty()) {
            $this->error('No required vendor slugs found. Check CONFERENCE_UUID and conference_sponsor rows on phptek_tv.');

            return self::FAILURE;
        }

        $count = (int) $this->option('count');
        $matchesOption = $this->option('matches');
        $matches = $matchesOption !== null ? (int) $matchesOption : $required->count();
        $matches = max(1, min($matches, $required->count()));

        $userUuids = DB::connection('phptek_tv')
            ->table('users')
            ->whereNotNull('uuid')
            ->inRandomOrder()
            ->limit($count)
            ->pluck('uuid');

        if ($userUuids->isEmpty()) {
            $this->error('No users found on phptek_tv to seed against.');

            return self::FAILURE;
        }

        $now = now();
        $rows = [];

        foreach ($userUuids as $uuid) {
            $slugsForUser = $required->shuffle()->take($matches);

            foreach ($slugsForUser as $slug) {
                $rows[] = [
                    'source_badge_uuid' => $uuid,
                    'target_type' => 'vendor',
                    'target_id' => $slug,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        $connection = DB::connection('mobile_app');
        $insertedIds = [];

        $connection->transaction(function () use ($connection, $rows, &$insertedIds) {
            foreach ($rows as $row) {
                $insertedIds[] = $connection->table('share_intents')->insertGetId($row);
            }
        });

        $this->trackInserted($insertedIds);

        $this->info(sprintf(
            'Seeded %d share_intents rows across %d attendees (matches=%d of %d required vendors).',
            count($insertedIds),
            $userUuids->count(),
            $matches,
            $required->count()
        ));
        $this->line('Run `php artisan giveaway:seed-demo --clear` to remove them.');

        return self::SUCCESS;
    }

    private function clear(): int
    {
        $ids = $this->loadTrackedIds();

        if (empty($ids)) {
            $this->info('No tracked demo rows to remove.');

            return self::SUCCESS;
        }

        $deleted = DB::connection('mobile_app')
            ->table('share_intents')
            ->whereIn('id', $ids)
            ->delete();

        Storage::disk('local')->delete(self::TRACKING_FILE);

        $this->info("Removed {$deleted} demo share_intents rows.");

        return self::SUCCESS;
    }

    /**
     * @param  array<int, int>  $newIds
     */
    private function trackInserted(array $newIds): void
    {
        $existing = $this->loadTrackedIds();
        $merged = array_values(array_unique([...$existing, ...$newIds]));

        Storage::disk('local')->put(self::TRACKING_FILE, json_encode($merged, JSON_PRETTY_PRINT));
    }

    /**
     * @return array<int, int>
     */
    private function loadTrackedIds(): array
    {
        if (! Storage::disk('local')->exists(self::TRACKING_FILE)) {
            return [];
        }

        $raw = Storage::disk('local')->get(self::TRACKING_FILE);
        $decoded = json_decode($raw, true);

        return is_array($decoded) ? array_map('intval', $decoded) : [];
    }
}
