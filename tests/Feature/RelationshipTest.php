<?php

use App\Models\Conference;
use App\Models\Sponsor;
use App\Models\User;

test('conference has many sponsors through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid',
        'name' => 'Relationship Test Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $sponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($sponsor->uuid, [
        'sponsorship_level' => 'gold',
    ]);

    $conference->refresh();

    expect($conference->sponsors)->toHaveCount(1);
    expect($conference->sponsors->first()->name)->toBe($sponsor->name);
    expect($conference->sponsors->first()->pivot->sponsorship_level)->toBe('gold');
});

test('sponsor belongs to many conferences through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-2',
        'name' => 'Reverse Relationship Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $sponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($sponsor->uuid, [
        'sponsorship_level' => 'silver',
    ]);

    $sponsor->refresh();

    expect($sponsor->conferences)->toHaveCount(1);
    expect($sponsor->conferences->first()->name)->toBe($conference->name);
    expect($sponsor->conferences->first()->pivot->sponsorship_level)->toBe('silver');
});

test('conference has many users through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-3',
        'name' => 'User Relationship Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $user = User::factory()->create();

    $conference->users()->attach($user->uuid);

    $conference->refresh();

    expect($conference->users)->toHaveCount(1);
    expect($conference->users->first()->email)->toBe($user->email);
});

test('conference can have multiple sponsors at different levels', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-4',
        'name' => 'Multi Sponsor Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $goldSponsor = Sponsor::factory()->withTestLogo()->create();
    $silverSponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($goldSponsor->uuid, [
        'sponsorship_level' => 'gold',
    ]);

    $conference->sponsors()->attach($silverSponsor->uuid, [
        'sponsorship_level' => 'silver',
    ]);

    $conference->refresh();

    expect($conference->sponsors)->toHaveCount(2);

    $levels = $conference->sponsors->pluck('pivot.sponsorship_level')->toArray();
    expect($levels)->toContain('gold');
    expect($levels)->toContain('silver');
});
