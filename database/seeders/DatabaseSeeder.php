<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call the ConferenceSeeder
        $this->call(ConferenceSeeder::class);

        // Call the SponsorSeeder
        $this->call(SponsorSeeder::class);

        // Call the ConferenceSponsorSeeder
        $this->call(ConferenceSponsorSeeder::class);

        // Call the UserSeeder
        $this->call(UserSeeder::class);

        // Call the ConferenceUserSeeder
        $this->call(ConferenceUserSeeder::class);
    }
}
