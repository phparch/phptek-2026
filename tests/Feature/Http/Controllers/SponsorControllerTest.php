<?php

use App\Models\Conference;
use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->conference = Conference::create([
        'uuid' => 'test-conference-uuid',
        'name' => 'PHP Tek 2026',
        'venue_name' => 'Test Venue',
        'venue_city' => 'Chicago',
        'venue_state' => 'IL',
        'venue_country' => 'US',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    config(['tek.conference.uuid' => 'test-conference-uuid']);
});

test('partners section renders sponsors with website', function () {
    $sponsor = Sponsor::factory()->create([
        'website' => 'https://example.com',
    ]);

    $this->conference->sponsors()->attach($sponsor->uuid, [
        'sponsor_uuid' => $sponsor->uuid,
        'conference_uuid' => $this->conference->uuid,
        'sponsorship_level' => 'gold',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee($sponsor->name, false);
    $response->assertSee('example.com', false);
});

test('partners section renders sponsors without website without errors', function () {
    $sponsor = Sponsor::factory()->withoutWebsite()->create();

    $this->conference->sponsors()->attach($sponsor->uuid, [
        'sponsor_uuid' => $sponsor->uuid,
        'conference_uuid' => $this->conference->uuid,
        'sponsorship_level' => 'gold',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee($sponsor->name, false);
});

test('partners section handles mix of sponsors with and without websites', function () {
    $sponsorWithSite = Sponsor::factory()->create([
        'website' => 'https://has-website.com',
    ]);

    $sponsorWithoutSite = Sponsor::factory()->withoutWebsite()->create();

    $this->conference->sponsors()->attach($sponsorWithSite->uuid, [
        'sponsor_uuid' => $sponsorWithSite->uuid,
        'conference_uuid' => $this->conference->uuid,
        'sponsorship_level' => 'gold',
    ]);

    $this->conference->sponsors()->attach($sponsorWithoutSite->uuid, [
        'sponsor_uuid' => $sponsorWithoutSite->uuid,
        'conference_uuid' => $this->conference->uuid,
        'sponsorship_level' => 'silver',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee($sponsorWithSite->name, false);
    $response->assertSee($sponsorWithoutSite->name, false);
});
