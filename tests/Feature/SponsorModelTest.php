<?php

declare(strict_types=1);

use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;

test('logoUrl returns null when logo is empty', function () {
    $sponsor = Sponsor::factory()->make(['logo' => null]);

    expect($sponsor->logo_url)->toBeNull();
});

test('logoUrl returns http url as-is', function () {
    $sponsor = Sponsor::factory()->make([
        'logo' => 'https://example.com/logo.png',
    ]);

    expect($sponsor->logo_url)->toBe('https://example.com/logo.png');
});

test('logoUrl returns asset url for existing public file', function () {
    $sponsor = Sponsor::factory()->make([
        'logo' => 'favicon.ico',
    ]);

    expect($sponsor->logo_url)->toContain('favicon.ico');
});

test('logoUrl falls back to s3 for non-public relative paths', function () {
    Storage::fake('s3');

    $sponsor = Sponsor::factory()->make([
        'logo' => 'vendor_logos/some-logo.png',
    ]);

    $url = $sponsor->logo_url;

    expect($url)->toContain('vendor_logos/some-logo.png');
});

test('logoUrl prepends vendor_logos prefix for bare paths on s3', function () {
    Storage::fake('s3');

    $sponsor = Sponsor::factory()->make([
        'logo' => 'some-logo.png',
    ]);

    $url = $sponsor->logo_url;

    expect($url)->toContain('vendor_logos/some-logo.png');
});
