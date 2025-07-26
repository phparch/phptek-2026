<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConferenceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conferenceUuid = config('tek.conference.uuid');
        $conference = Conference::where('uuid', $conferenceUuid)->first();

        if (! $conference) {
            $this->command->error("Conference with UUID {$conferenceUuid} not found");

            return;
        }

        $users = User::all();
        $totalUsers = $users->count();
        $usersToAssign = (int) ($totalUsers * 0.85); // 85% of users

        // Get random 85% of users
        $selectedUsers = $users->random($usersToAssign);

        // Attach users to conference
        $conference->users()->attach(
            $selectedUsers->pluck('uuid')->toArray(),
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info("Conference-User relationships seeded successfully. {$usersToAssign} out of {$totalUsers} users assigned to conference.");
    }
}
