<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $conference = app('conference');

    return view('welcome', compact('conference'));
})->name('home');

Route::view('/giveaway', 'giveaway')
    ->middleware(\App\Http\Middleware\GiveawayPassword::class)
    ->name('giveaway');

Route::view('/giveaway/unlock', 'giveaway-unlock')->name('giveaway.unlock');
