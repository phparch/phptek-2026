# PR #54 Review Fixes Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix issues identified in PR #54 code review comments and add tests for identified coverage gaps.

**Architecture:** Fix the SponsorControllerTest to avoid S3 dependency by using HTTP logo URLs in the factory, clean up redundant code in attach() calls and RefreshDatabase import, and add new tests for the Sponsor `logoUrl` accessor and model relationships.

**Tech Stack:** Laravel 12, Pest PHP, SQLite (test), PHP 8.4

---

## Review Comment Triage

### Will Fix
1. **S3 dependency in tests (CodeRabbit - Major)** — Factory generates relative logo paths triggering `Storage::disk('s3')->url()`. Fix by adding a `withTestLogo()` factory state that uses an HTTP URL.
2. **Redundant `uses(RefreshDatabase::class)` (Copilot)** — Already applied globally in `tests/Pest.php:15`. Remove.
3. **Redundant pivot attributes in `attach()` (Copilot + CodeRabbit)** — Remove `sponsor_uuid` and `conference_uuid` from attach calls; the relationship handles them.

### Will NOT Fix (with justification)
1. **Migration missing `down()` method** — Project convention in CLAUDE.md: "do not write down methods in migrations, only up methods."
2. **Migration `->change()` without doctrine/dbal** — False positive. Laravel 11+ handles `->change()` natively without doctrine/dbal.
3. **Dynamic property `$this->conference` PHP 8.4 deprecation** — Standard Pest PHP pattern. Pest's test case handles dynamic properties via magic methods. This is idiomatic Pest code.
4. **File path doesn't match behavior tested** — Low-priority cosmetic change. Would rename file but not change behavior. Deferring to avoid unnecessary churn.
5. **fwallen's `sponsor.websiteEl` comment** — The code at lines 162-171 already uses a local `websiteEl` variable correctly. The code is `websiteEl.href = sponsor.website` which is correct. Eric confirmed in the thread.

## File Structure

| File | Action | Responsibility |
|------|--------|----------------|
| `tests/Feature/Http/Controllers/SponsorControllerTest.php` | Modify | Fix S3 dep, remove redundant RefreshDatabase, clean attach() calls |
| `database/factories/SponsorFactory.php` | Modify | Add `withTestLogo()` state for tests |
| `tests/Feature/SponsorModelTest.php` | Create | Test `logoUrl` accessor edge cases |
| `tests/Feature/RelationshipTest.php` | Create | Test Conference-Sponsor and Conference-User relationships |

---

### Task 1: Add `withTestLogo()` Factory State

**Files:**
- Modify: `database/factories/SponsorFactory.php:46`

- [ ] **Step 1: Add the factory state method**

Add after the `withoutWebsite()` method:

```php
/**
 * Create a sponsor with an HTTP logo URL (avoids S3 dependency in tests).
 */
public function withTestLogo(): static
{
    return $this->state(fn (array $attributes) => [
        'logo' => 'https://example.com/logos/test-logo.png',
    ]);
}
```

- [ ] **Step 2: Verify factory still works**

Run: `php artisan tinker --execute="echo App\Models\Sponsor::factory()->withTestLogo()->make()->logo_url;"`
Expected: `https://example.com/logos/test-logo.png`

- [ ] **Step 3: Commit**

```bash
git add database/factories/SponsorFactory.php
git commit -m "feat: add withTestLogo factory state to avoid S3 dependency in tests"
```

---

### Task 2: Fix SponsorControllerTest

**Files:**
- Modify: `tests/Feature/Http/Controllers/SponsorControllerTest.php`

- [ ] **Step 1: Remove redundant RefreshDatabase import and usage**

Remove line 5 (`use Illuminate\Foundation\Testing\RefreshDatabase;`) and line 7 (`uses(RefreshDatabase::class);`). This is already applied globally in `tests/Pest.php:14-16`.

- [ ] **Step 2: Update all `Sponsor::factory()` calls to chain `->withTestLogo()`**

Every `Sponsor::factory()` call must include `->withTestLogo()` to avoid S3:

```php
// Line 25 - sponsor with website
$sponsor = Sponsor::factory()->withTestLogo()->create([
    'website' => 'https://example.com',
]);

// Line 43 - sponsor without website
$sponsor = Sponsor::factory()->withTestLogo()->withoutWebsite()->create();

// Line 58 - sponsor with site
$sponsorWithSite = Sponsor::factory()->withTestLogo()->create([
    'website' => 'https://has-website.com',
]);

// Line 62 - sponsor without site
$sponsorWithoutSite = Sponsor::factory()->withTestLogo()->withoutWebsite()->create();
```

- [ ] **Step 3: Clean up all `attach()` calls to remove redundant pivot keys**

Replace each attach call. Only pass `sponsorship_level` — Laravel fills the foreign keys automatically.

Before:
```php
$this->conference->sponsors()->attach($sponsor->uuid, [
    'sponsor_uuid' => $sponsor->uuid,
    'conference_uuid' => $this->conference->uuid,
    'sponsorship_level' => 'gold',
]);
```

After:
```php
$this->conference->sponsors()->attach($sponsor->uuid, [
    'sponsorship_level' => 'gold',
]);
```

Apply to all 4 attach calls (lines 29, 45, 64, 70).

- [ ] **Step 4: Run tests to verify they pass**

Run: `php artisan test --filter=SponsorControllerTest`
Expected: 3 tests pass, 0 failures

- [ ] **Step 5: Commit**

```bash
git add tests/Feature/Http/Controllers/SponsorControllerTest.php
git commit -m "fix: remove S3 dependency, redundant RefreshDatabase, and redundant pivot keys in sponsor tests"
```

---

### Task 3: Add Sponsor `logoUrl` Accessor Tests

**Files:**
- Create: `tests/Feature/SponsorModelTest.php`

- [ ] **Step 1: Create the test file**

Run: `php artisan make:test SponsorModelTest --pest`

- [ ] **Step 2: Write tests for all logoUrl branches**

The `logoUrl` accessor in `app/Models/Sponsor.php:62-87` has 4 branches:
1. No logo → returns null
2. HTTP URL logo → returns as-is
3. Local file exists → returns asset URL
4. Relative path (S3 fallback) → calls Storage::disk('s3')

```php
<?php

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
```

- [ ] **Step 3: Run the tests**

Run: `php artisan test tests/Feature/SponsorModelTest.php`
Expected: 5 tests pass

- [ ] **Step 4: Commit**

```bash
git add tests/Feature/SponsorModelTest.php
git commit -m "test: add comprehensive tests for Sponsor logoUrl accessor"
```

---

### Task 4: Add Model Relationship Tests

**Files:**
- Create: `tests/Feature/RelationshipTest.php`

- [ ] **Step 1: Create the test file**

Run: `php artisan make:test RelationshipTest --pest`

- [ ] **Step 2: Write relationship tests**

```php
<?php

use App\Models\Conference;
use App\Models\Sponsor;
use App\Models\User;

test('conference has many sponsors through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid',
        'name' => 'Relationship Test Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $sponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($sponsor->uuid, [
        'sponsorship_level' => 'gold',
    ]);

    $conference->refresh();

    expect($conference->sponsors)->toHaveCount(1);
    expect($conference->sponsors->first()->name)->toBe($sponsor->name);
    expect($conference->sponsors->first()->pivot->sponsorship_level)->toBe('gold');
});

test('sponsor belongs to many conferences through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-2',
        'name' => 'Reverse Relationship Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $sponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($sponsor->uuid, [
        'sponsorship_level' => 'silver',
    ]);

    $sponsor->refresh();

    expect($sponsor->conferences)->toHaveCount(1);
    expect($sponsor->conferences->first()->name)->toBe($conference->name);
    expect($sponsor->conferences->first()->pivot->sponsorship_level)->toBe('silver');
});

test('conference has many users through pivot', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-3',
        'name' => 'User Relationship Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $user = User::factory()->create();

    $conference->users()->attach($user->uuid);

    $conference->refresh();

    expect($conference->users)->toHaveCount(1);
    expect($conference->users->first()->email)->toBe($user->email);
});

test('conference can have multiple sponsors at different levels', function () {
    $conference = Conference::create([
        'uuid' => 'rel-test-conf-uuid-4',
        'name' => 'Multi Sponsor Conference',
        'venue_name' => 'Test Venue',
        'start_date' => '2026-05-19',
        'end_date' => '2026-05-21',
    ]);

    $goldSponsor = Sponsor::factory()->withTestLogo()->create();
    $silverSponsor = Sponsor::factory()->withTestLogo()->create();

    $conference->sponsors()->attach($goldSponsor->uuid, [
        'sponsorship_level' => 'gold',
    ]);

    $conference->sponsors()->attach($silverSponsor->uuid, [
        'sponsorship_level' => 'silver',
    ]);

    $conference->refresh();

    expect($conference->sponsors)->toHaveCount(2);

    $levels = $conference->sponsors->pluck('pivot.sponsorship_level')->toArray();
    expect($levels)->toContain('gold');
    expect($levels)->toContain('silver');
});
```

- [ ] **Step 3: Run the tests**

Run: `php artisan test tests/Feature/RelationshipTest.php`
Expected: 4 tests pass

- [ ] **Step 4: Commit**

```bash
git add tests/Feature/RelationshipTest.php
git commit -m "test: add model relationship tests for Conference, Sponsor, and User"
```

---

### Task 5: Run Full Test Suite

- [ ] **Step 1: Run all tests**

Run: `php artisan test`
Expected: All tests pass (existing + new)

- [ ] **Step 2: Run Pint for formatting**

Run: `vendor/bin/pint --dirty`

- [ ] **Step 3: Final commit if Pint made changes**

```bash
git add -A
git commit -m "style: apply Pint formatting"
```
