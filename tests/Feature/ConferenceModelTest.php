<?php

namespace Tests\Feature;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConferenceModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the Conference model accessor methods.
     */
    public function test_conference_accessor_methods(): void
    {
        // Create a test conference
        $conference = Conference::create([
            'uuid' => 'test-uuid',
            'name' => 'Test Conference',
            'venue_name' => 'Test Venue',
            'venue_address' => '123 Test Street, Test City',
            'start_date' => '2026-06-01 09:00:00',
            'end_date' => '2026-06-03 17:00:00',
        ]);

        // Test accessor methods
        $this->assertEquals('Test Conference', $conference->getName());
        $this->assertEquals('123 Test Street, Test City', $conference->getVenueAddress());
        $this->assertEquals('2026-06-01', $conference->getStartDate()->format('Y-m-d'));
        $this->assertEquals('2026-06-03', $conference->getEndDate()->format('Y-m-d'));

        // Test helper methods
        $this->assertEquals('2026-06-01', $conference->formattedStartDate());
        $this->assertEquals('06/01/2026', $conference->formattedStartDate('m/d/Y'));
        $this->assertEquals('2026-06-03', $conference->formattedEndDate());
        $this->assertEquals('06/03/2026', $conference->formattedEndDate('m/d/Y'));

        // Test duration calculation
        $this->assertEquals(3, $conference->getDurationInDays());

        // Test isOngoing method (this will depend on the current date)
        // For testing purposes, we're just ensuring it returns a boolean
        $this->assertIsBool($conference->isOngoing());
    }

    /**
     * Test accessing conference attributes directly.
     */
    public function test_conference_direct_attribute_access(): void
    {
        // Create a test conference
        $conference = Conference::create([
            'uuid' => 'test-uuid-2',
            'name' => 'Another Test Conference',
            'venue_name' => 'Another Venue',
            'venue_address' => '456 Test Avenue, Test Town',
            'start_date' => '2026-07-01 09:00:00',
            'end_date' => '2026-07-02 17:00:00',
        ]);

        // Test direct attribute access (Laravel's magic getters)
        $this->assertEquals('Another Test Conference', $conference->name);
        $this->assertEquals('456 Test Avenue, Test Town', $conference->venue_address);
        $this->assertEquals('2026-07-01', $conference->start_date->format('Y-m-d'));
        $this->assertEquals('2026-07-02', $conference->end_date->format('Y-m-d'));
    }

    /**
     * Test the formatted date range method.
     */
    public function test_formatted_date_range(): void
    {
        // Test case 1: Dates in the same month
        $conference1 = Conference::create([
            'uuid' => 'test-uuid-3',
            'name' => 'Same Month Conference',
            'start_date' => '2026-05-19 09:00:00',
            'end_date' => '2026-05-21 17:00:00',
        ]);

        // Should format as "May 19th - 21st, 2026"
        $this->assertEquals('May 19th - 21st, 2026', $conference1->getFormattedDateRange());

        // Test case 2: Dates in different months
        $conference2 = Conference::create([
            'uuid' => 'test-uuid-4',
            'name' => 'Different Month Conference',
            'start_date' => '2026-05-30 09:00:00',
            'end_date' => '2026-06-02 17:00:00',
        ]);

        // Should format as "May 30th - June 2nd, 2026"
        $this->assertEquals('May 30th - June 2nd, 2026', $conference2->getFormattedDateRange());

        // Test case 3: Conference with null dates
        $conference3 = Conference::create([
            'uuid' => 'test-uuid-5',
            'name' => 'No Dates Conference',
        ]);

        // Should return null when dates are not set
        $this->assertNull($conference3->getFormattedDateRange());
    }
}
