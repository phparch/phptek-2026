<?php

namespace App\Enums;

enum SponsorLevelEnum: string
{
    case Platinum = 'platinum';
    case Gold = 'gold';
    case Silver = 'silver';
    case Bronze = 'bronze';
    case Community = 'community';
    case Media = 'media';
    case Diversity = 'diversity';
    case Venue = 'venue';
    case AfterParty = 'after-party';
    case Other = 'other';
}
