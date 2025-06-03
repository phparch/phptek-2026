<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the conference with the specified UUID already exists
        $conferenceUuid = config('tek.conference.uuid');

        if (!Conference::where('uuid', $conferenceUuid)->exists()) {
            Conference::create([
                'uuid' => $conferenceUuid,
                'name' => 'PHP TEK 2026',
                'venue_name' => 'Sheraton Suites Chicago O\'Hare',
                'venue_address' => '6501 Mannheim Road, Rosemont, Illinois, USA, 60018',
                'start_date' => '2026-05-19 09:00:00',
                'end_date' => '2026-05-21 17:00:00',
            ]);

            $this->command->info('Conference seeded successfully.');
        } else {
            $this->command->info('Conference already exists, skipping seeding.');
        }
    }
}
