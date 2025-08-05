<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PHP Architect - will be Platinum sponsor
        Sponsor::factory()->phpArchitect()->create();

        // Additional sponsors for testing different levels
        Sponsor::factory()->count(8)->create();

        $this->command->info('Partners seeded successfully');
    }
}
