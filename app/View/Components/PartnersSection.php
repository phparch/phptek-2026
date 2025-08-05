<?php

namespace App\View\Components;

use App\Enums\SponsorLevelEnum;
use App\Models\Conference;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class PartnersSection extends Component
{
    public Collection $sponsorsByLevel;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sponsorsByLevel = $this->getSponsorsGroupedByLevel();
    }

    /**
     * Get sponsors grouped by their sponsorship level for the current conference.
     */
    private function getSponsorsGroupedByLevel(): Collection
    {
        $conferenceUuid = config('tek.conference.uuid');
        $conference = Conference::where('uuid', $conferenceUuid)->first();

        if (! $conference) {
            return collect();
        }

        $sponsors = $conference->sponsors()
            ->withPivot('sponsorship_level', 'sponsorship_level_details')
            ->get()
            ->groupBy('pivot.sponsorship_level');

        // Sort by sponsor level hierarchy
        $levelOrder = [
            SponsorLevelEnum::Platinum->value => 1,
            SponsorLevelEnum::Gold->value => 2,
            SponsorLevelEnum::Silver->value => 3,
            SponsorLevelEnum::Bronze->value => 4,
            SponsorLevelEnum::Community->value => 5,
            SponsorLevelEnum::Media->value => 6,
            SponsorLevelEnum::Diversity->value => 7,
            SponsorLevelEnum::Venue->value => 8,
            SponsorLevelEnum::AfterParty->value => 9,
            SponsorLevelEnum::Other->value => 10,
        ];

        return $sponsors->sortBy(function ($sponsors, $level) use ($levelOrder) {
            return $levelOrder[$level] ?? 999;
        });
    }

    /**
     * Get the display name for a sponsorship level.
     */
    public function getLevelDisplayName(string $level): string
    {
        return match ($level) {
            'platinum' => 'Platinum Partners',
            'gold' => 'Gold Partners',
            'silver' => 'Silver Partners',
            'bronze' => 'Bronze Partners',
            'community' => 'Community Partners',
            'media' => 'Media Partners',
            'diversity' => 'Diversity Partners',
            'venue' => 'Venue Partners',
            'after-party' => 'After Party Partners',
            'other' => 'Special Partners',
            default => ucfirst($level).' Partners',
        };
    }

    /**
     * Get the grid classes for a sponsorship level.
     */
    public function getGridClasses(string $level): string
    {
        return match ($level) {
            'platinum' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
            'gold' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
            'silver', 'bronze' => 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4',
            default => 'grid-cols-2 md:grid-cols-3 lg:grid-cols-5',
        };
    }

    /**
     * Get the card size classes for a sponsorship level.
     */
    public function getCardClasses(string $level): string
    {
        return match ($level) {
            'platinum' => 'p-8 h-32',
            'gold' => 'p-6 h-24',
            'silver', 'bronze' => 'p-4 h-20',
            default => 'p-3 h-16',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partners-section');
    }
}
