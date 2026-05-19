<?php

use App\Services\GiveawayEligibility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $this->externalDbPath = tempnam(sys_get_temp_dir(), 'giveaway_test_');

    foreach (['phptek_tv', 'mobile_app'] as $connection) {
        config()->set("database.connections.{$connection}", [
            'driver' => 'sqlite',
            'database' => $this->externalDbPath,
            'prefix' => '',
            'foreign_key_constraints' => false,
        ]);

        DB::purge($connection);
    }

    Schema::connection('phptek_tv')->create('conferences', function ($table) {
        $table->bigIncrements('id');
        $table->string('uuid')->nullable();
        $table->string('name')->nullable();
        $table->timestamp('start_date')->nullable();
        $table->timestamp('end_date')->nullable();
    });

    Schema::connection('phptek_tv')->create('sponsors', function ($table) {
        $table->bigIncrements('id');
        $table->string('uuid')->nullable();
        $table->string('slug')->nullable();
        $table->string('name')->nullable();
    });

    Schema::connection('phptek_tv')->create('conference_sponsor', function ($table) {
        $table->string('conference_uuid');
        $table->string('sponsor_uuid');
        $table->boolean('skip_for_giveaway')->default(false);
    });

    Schema::connection('phptek_tv')->create('users', function ($table) {
        $table->bigIncrements('id');
        $table->string('uuid')->nullable();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('email')->nullable();
    });

    Schema::connection('mobile_app')->create('share_intents', function ($table) {
        $table->bigIncrements('id');
        $table->string('source_badge_uuid')->nullable();
        $table->string('target_type')->nullable();
        $table->string('target_id')->nullable();
        $table->timestamp('created_at')->nullable();
    });

    Schema::connection('mobile_app')->create('vendor_contacts', function ($table) {
        $table->bigIncrements('id');
        $table->string('badge_uuid')->nullable();
        $table->string('vendor_id')->nullable();
        $table->timestamp('scanned_at')->nullable();
        $table->timestamp('deleted_at')->nullable();
    });
});

afterEach(function () {
    foreach (['phptek_tv', 'mobile_app'] as $connection) {
        DB::purge($connection);
    }

    if (isset($this->externalDbPath) && file_exists($this->externalDbPath)) {
        unlink($this->externalDbPath);
    }
});

function seedGiveawayScenario(): array
{
    $currentUuid = 'conf-current-uuid';
    config()->set('tek.conference.uuid', $currentUuid);

    $conferenceId = DB::connection('phptek_tv')->table('conferences')->insertGetId([
        'uuid' => $currentUuid,
        'name' => 'PHP Tek 2026',
    ]);

    DB::connection('phptek_tv')->table('conferences')->insert([
        'uuid' => 'conf-archived-uuid',
        'name' => 'PHP Tek 2025',
    ]);

    $sponsorUuids = [];
    foreach (['acme', 'beta', 'skipme'] as $slug) {
        $sponsorUuids[$slug] = "sponsor-{$slug}-uuid";
        DB::connection('phptek_tv')->table('sponsors')->insert([
            'uuid' => $sponsorUuids[$slug],
            'slug' => $slug,
            'name' => ucfirst($slug).' Inc.',
        ]);
    }

    DB::connection('phptek_tv')->table('conference_sponsor')->insert([
        ['conference_uuid' => $currentUuid, 'sponsor_uuid' => $sponsorUuids['acme'], 'skip_for_giveaway' => false],
        ['conference_uuid' => $currentUuid, 'sponsor_uuid' => $sponsorUuids['beta'], 'skip_for_giveaway' => false],
        ['conference_uuid' => $currentUuid, 'sponsor_uuid' => $sponsorUuids['skipme'], 'skip_for_giveaway' => true],
    ]);

    return ['conferenceUuid' => $currentUuid];
}

it('returns required vendor slugs excluding skipped pivot rows', function () {
    seedGiveawayScenario();

    $required = app(GiveawayEligibility::class)->requiredVendorSlugs();

    expect($required->sort()->values()->all())->toBe(['acme', 'beta']);
});

it('returns no eligible attendees when there is no current conference', function () {
    config()->set('tek.conference.uuid', 'missing-uuid');

    DB::connection('phptek_tv')->table('conferences')->insert([
        'uuid' => 'some-other-uuid',
        'name' => 'PHP Tek 2025',
    ]);

    expect(app(GiveawayEligibility::class)->eligibleBadgeUuids()->all())->toBe([]);
});

it('returns no eligible attendees when the required set is empty', function () {
    $uuid = 'conf-no-sponsors';
    config()->set('tek.conference.uuid', $uuid);

    DB::connection('phptek_tv')->table('conferences')->insert([
        'uuid' => $uuid,
        'name' => 'PHP Tek 2026',
    ]);

    expect(app(GiveawayEligibility::class)->eligibleBadgeUuids()->all())->toBe([]);
});

it('identifies eligible attendees across both interaction directions', function () {
    seedGiveawayScenario();

    $uuidA = 'badge-aaaaaaaa';
    $uuidB = 'badge-bbbbbbbb';
    $uuidC = 'badge-cccccccc';

    DB::connection('mobile_app')->table('share_intents')->insert([
        ['source_badge_uuid' => $uuidA, 'target_type' => 'vendor', 'target_id' => 'acme'],
        ['source_badge_uuid' => $uuidA, 'target_type' => 'vendor', 'target_id' => 'beta'],
        ['source_badge_uuid' => $uuidB, 'target_type' => 'vendor', 'target_id' => 'acme'],
        ['source_badge_uuid' => $uuidC, 'target_type' => 'vendor', 'target_id' => 'skipme'],
        ['source_badge_uuid' => $uuidA, 'target_type' => 'speaker', 'target_id' => 'acme'],
    ]);

    DB::connection('mobile_app')->table('vendor_contacts')->insert([
        ['badge_uuid' => $uuidB, 'vendor_id' => 'beta'],
        ['badge_uuid' => null, 'vendor_id' => 'acme'],
    ]);

    $service = app(GiveawayEligibility::class);

    expect($service->eligibleBadgeUuids()->sort()->values()->all())
        ->toBe([$uuidA, $uuidB]);

    expect($service->missingVendorsFor($uuidC)->sort()->values()->all())
        ->toBe(['acme', 'beta']);

    expect($service->missingVendorsFor($uuidA)->all())->toBe([]);
});

it('honors GIVEAWAY_DEMO_MIN_MATCHES to relax the eligibility threshold', function () {
    seedGiveawayScenario();
    config()->set('tek.giveaway.demo_min_matches', 1);

    $uuidPartial = 'badge-partial';
    $uuidNone = 'badge-none';

    DB::connection('mobile_app')->table('share_intents')->insert([
        ['source_badge_uuid' => $uuidPartial, 'target_type' => 'vendor', 'target_id' => 'acme'],
        ['source_badge_uuid' => $uuidNone, 'target_type' => 'vendor', 'target_id' => 'skipme'],
    ]);

    $eligible = app(GiveawayEligibility::class)->eligibleBadgeUuids()->all();

    expect($eligible)->toBe([$uuidPartial]);
});

it('ignores soft-deleted vendor_contacts rows', function () {
    seedGiveawayScenario();

    $uuid = 'badge-deleted';

    DB::connection('mobile_app')->table('vendor_contacts')->insert([
        ['badge_uuid' => $uuid, 'vendor_id' => 'acme', 'deleted_at' => null],
        ['badge_uuid' => $uuid, 'vendor_id' => 'beta', 'deleted_at' => now()],
    ]);

    $interactions = app(GiveawayEligibility::class)
        ->interactionsByAttendee()
        ->get($uuid, collect())
        ->all();

    expect($interactions)->toBe(['acme']);
});

it('returns eligible attendees with names joined from phptek_tv users', function () {
    seedGiveawayScenario();

    $uuidA = 'badge-aaaaaaaa';
    $uuidB = 'badge-bbbbbbbb';

    DB::connection('phptek_tv')->table('users')->insert([
        ['uuid' => $uuidA, 'first_name' => 'Alice', 'last_name' => 'Anderson', 'email' => 'a@example.com'],
        ['uuid' => $uuidB, 'first_name' => 'Bob', 'last_name' => 'Brown', 'email' => 'b@example.com'],
    ]);

    DB::connection('mobile_app')->table('share_intents')->insert([
        ['source_badge_uuid' => $uuidA, 'target_type' => 'vendor', 'target_id' => 'acme'],
        ['source_badge_uuid' => $uuidA, 'target_type' => 'vendor', 'target_id' => 'beta'],
        ['source_badge_uuid' => $uuidB, 'target_type' => 'vendor', 'target_id' => 'acme'],
        ['source_badge_uuid' => $uuidB, 'target_type' => 'vendor', 'target_id' => 'beta'],
    ]);

    $attendees = app(GiveawayEligibility::class)->eligibleAttendees();

    expect($attendees->pluck('name')->sort()->values()->all())
        ->toBe(['Alice Anderson', 'Bob Brown']);

    expect($attendees->pluck('badge_uuid')->sort()->values()->all())
        ->toBe([$uuidA, $uuidB]);
});

it('statusForEmail returns a per-vendor scan status for a known attendee', function () {
    seedGiveawayScenario();

    $uuid = 'badge-known';
    DB::connection('phptek_tv')->table('users')->insert([
        'uuid' => $uuid,
        'first_name' => 'Known',
        'last_name' => 'Attendee',
        'email' => 'known@example.com',
    ]);

    DB::connection('mobile_app')->table('share_intents')->insert([
        ['source_badge_uuid' => $uuid, 'target_type' => 'vendor', 'target_id' => 'acme'],
    ]);

    DB::connection('mobile_app')->table('vendor_contacts')->insert([
        ['badge_uuid' => $uuid, 'vendor_id' => 'beta'],
    ]);

    $status = app(GiveawayEligibility::class)->statusForEmail('known@example.com');

    expect($status['user_uuid'])->toBe($uuid);
    expect($status['required_count'])->toBe(2);
    expect($status['scanned_count'])->toBe(2);
    expect($status['qualified'])->toBeTrue();
    expect(collect($status['rows'])->where('scanned', true)->pluck('slug')->sort()->values()->all())
        ->toBe(['acme', 'beta']);
});

it('statusForEmail returns uuid-not-found and randomly-assigned rows for an unknown email', function () {
    seedGiveawayScenario();

    $status = app(GiveawayEligibility::class)->statusForEmail('nobody@example.com');

    expect($status['user_uuid'])->toBe('uuid-not-found');
    expect($status['required_count'])->toBe(2);
    expect(count($status['rows']))->toBe(2);
    expect(collect($status['rows'])->pluck('slug')->sort()->values()->all())->toBe(['acme', 'beta']);
    foreach ($status['rows'] as $row) {
        expect($row['scanned'])->toBeIn([true, false]);
    }
});

it('statusForEmail never marks an unknown email as qualified and always shows some of both', function () {
    seedGiveawayScenario();

    foreach (range(1, 50) as $_) {
        $status = app(GiveawayEligibility::class)->statusForEmail('rando-'.uniqid().'@example.com');
        expect($status['user_uuid'])->toBe('uuid-not-found');
        expect($status['qualified'])->toBeFalse();
        expect($status['scanned_count'])->toBeGreaterThanOrEqual(1);
        expect($status['scanned_count'])->toBeLessThan($status['required_count']);
    }
});

it('statusForEmail excludes interactions outside the current conference dates', function () {
    seedGiveawayScenario();

    DB::connection('phptek_tv')->table('conferences')
        ->where('uuid', 'conf-current-uuid')
        ->update([
            'start_date' => '2026-05-19 00:00:00',
            'end_date' => '2026-05-21 23:59:59',
        ]);

    $uuid = 'badge-date-test';
    DB::connection('phptek_tv')->table('users')->insert([
        'uuid' => $uuid,
        'email' => 'datetest@example.com',
    ]);

    DB::connection('mobile_app')->table('share_intents')->insert([
        ['source_badge_uuid' => $uuid, 'target_type' => 'vendor', 'target_id' => 'acme', 'created_at' => '2026-05-20 12:00:00'],
        ['source_badge_uuid' => $uuid, 'target_type' => 'vendor', 'target_id' => 'beta', 'created_at' => '2025-01-01 12:00:00'],
    ]);

    $status = app(GiveawayEligibility::class)->statusForEmail('datetest@example.com');

    expect($status['scanned_count'])->toBe(1);
    expect(collect($status['rows'])->where('scanned', true)->pluck('slug')->all())->toBe(['acme']);
});

it('exposes sponsor names keyed by slug', function () {
    seedGiveawayScenario();

    $names = app(GiveawayEligibility::class)->sponsorNamesBySlug();

    expect($names)->toMatchArray([
        'acme' => 'Acme Inc.',
        'beta' => 'Beta Inc.',
        'skipme' => 'Skipme Inc.',
    ]);
});
