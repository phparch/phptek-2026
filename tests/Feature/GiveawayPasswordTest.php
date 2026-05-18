<?php

use App\Http\Middleware\GiveawayPassword;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

beforeEach(function () {
    Route::get('/__test/giveaway', fn () => 'ok')
        ->middleware(['web', GiveawayPassword::class])
        ->name('giveaway');

    Route::get('/__test/giveaway/unlock', fn () => 'unlock-page')
        ->middleware('web')
        ->name('giveaway.unlock');

    RateLimiter::clear('giveaway-unlock:127.0.0.1');
});

it('passes through when no password is configured', function () {
    config()->set('tek.giveaway.password', null);

    $this->get('/__test/giveaway')->assertOk()->assertSee('ok');
});

it('redirects to the unlock page when password is configured and not authed', function () {
    config()->set('tek.giveaway.password', 'secret');

    $this->get('/__test/giveaway')->assertRedirect(route('giveaway.unlock'));
});

it('allows access once session flag is set', function () {
    config()->set('tek.giveaway.password', 'secret');

    $this->withSession(['giveaway_authed' => true])
        ->get('/__test/giveaway')
        ->assertOk();
});

it('unlocks with the correct password and sets the session flag', function () {
    config()->set('tek.giveaway.password', 'secret');

    Volt::test('giveaway-unlock')
        ->set('password', 'secret')
        ->call('unlock')
        ->assertHasNoErrors()
        ->assertRedirect('/giveaway');

    expect(session('giveaway_authed'))->toBeTrue();
});

it('rejects an incorrect password and does not set the session flag', function () {
    config()->set('tek.giveaway.password', 'secret');

    Volt::test('giveaway-unlock')
        ->set('password', 'wrong')
        ->call('unlock')
        ->assertHasErrors(['password']);

    expect(session('giveaway_authed'))->toBeNull();
});

it('rate limits brute-force attempts after five failures', function () {
    config()->set('tek.giveaway.password', 'secret');

    foreach (range(1, 5) as $_) {
        Volt::test('giveaway-unlock')
            ->set('password', 'wrong')
            ->call('unlock')
            ->assertHasErrors(['password']);
    }

    Volt::test('giveaway-unlock')
        ->set('password', 'secret')
        ->call('unlock')
        ->assertHasErrors(['password']);

    expect(session('giveaway_authed'))->toBeNull();
});
