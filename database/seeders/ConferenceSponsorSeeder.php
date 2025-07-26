<?php

namespace Database\Seeders;

use App\Enums\SponsorLevelEnum;
use App\Models\Conference;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class ConferenceSponsorSeeder extends Seeder
{
    public function run(): void
    {
        $conferenceUuid = config('tek.conference.uuid');
        $conference = Conference::where('uuid', $conferenceUuid)->first();

        if (! $conference) {
            $this->command->error("Conference with UUID {$conferenceUuid} not found");

            return;
        }

        $phpArchitectSponsor = Sponsor::where('name', 'PHP Architect')->first();

        if (! $phpArchitectSponsor) {
            $this->command->error('PHP Architect sponsor not found');

            return;
        }

        // Attach PHP Architect as Platinum sponsor
        $conference->sponsors()->attach($phpArchitectSponsor->uuid, [
            'sponsorship_level' => SponsorLevelEnum::Platinum->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attach other sponsors with various levels
        $otherSponsors = Sponsor::where('name', '!=', 'PHP Architect')->get();
        $sponsorLevels = [
            SponsorLevelEnum::Gold,
            SponsorLevelEnum::Silver,
            SponsorLevelEnum::Bronze,
            SponsorLevelEnum::Community,
            SponsorLevelEnum::Other,
        ];

        foreach ($otherSponsors as $index => $sponsor) {
            $level = $sponsorLevels[$index % count($sponsorLevels)];
            $levelDetails = null;

            // For 'other' sponsors, add custom level details
            if ($level === SponsorLevelEnum::Other) {
                $levelDetails = ['Coffee Sponsor', 'Lunch Sponsor', 'WiFi Sponsor'][array_rand(['Coffee Sponsor', 'Lunch Sponsor', 'WiFi Sponsor'])];
            }

            $conference->sponsors()->attach($sponsor->uuid, [
                'sponsorship_level' => $level->value,
                'sponsorship_level_details' => $levelDetails,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Conference-Sponsor relationships seeded successfully');
    }
}
