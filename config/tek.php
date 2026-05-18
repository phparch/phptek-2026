<?php

return [
    'conference' => [
        'uuid' => env('CONFERENCE_UUID'),
        'timezone' => env('CONFERENCE_TIMEZONE', 'UTC'),
    ],

    'giveaway' => [
        'demo_min_matches' => env('GIVEAWAY_DEMO_MIN_MATCHES'),
        'password' => env('GIVEAWAY_PASSWORD'),
    ],
];
