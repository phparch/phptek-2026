<?php

namespace Tests\Feature;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SinglePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_successful_response(): void
    {
        // Create a conference for the home page to display
        Conference::create([
            'uuid' => 'test-uuid',
            'name' => 'PHP Tek 2026',
            'venue_name' => 'Test Venue',
            'venue_address' => '123 Test Street, Test City',
            'start_date' => '2026-06-01 09:00:00',
            'end_date' => '2026-06-03 17:00:00',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_contains_required_components(): void
    {
        // Create a conference for the home page to display
        Conference::create([
            'uuid' => 'test-uuid',
            'name' => 'PHP Tek 2026',
            'venue_name' => 'Test Venue',
            'venue_address' => '123 Test Street, Test City',
            'start_date' => '2026-06-01 09:00:00',
            'end_date' => '2026-06-03 17:00:00',
        ]);

        $response = $this->get('/');

        // Check for page title
        $response->assertSee('PHP Tek 2026 - The Premier PHP Conference', false);

        // Check for content that would be rendered by the navigation component
        $response->assertSee('About', false);
        $response->assertSee('Venue', false);
        $response->assertSee('Sponsors', false);
        $response->assertSee('Register', false);

        // Check for content that would be rendered by the about section
        $response->assertSee('About', false);

        // Check for content that would be rendered by the venue section
        $response->assertSee('Venue', false);

        // Check for content that would be rendered by the sponsors section
        $response->assertSee('Sponsors', false);

        // Check for content that would be rendered by the registration section
        $response->assertSee('Register', false);

        // Check for content that would be rendered by the footer
        $response->assertSee('PHP Tek Conference', false);
        $response->assertSee('&copy; ' . date('Y'), false);

        // Check for content that would be rendered by the code of conduct modal
        $response->assertSee('Code of Conduct', false);
    }
}
