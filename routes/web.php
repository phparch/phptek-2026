<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $conference = app('conference');

    return view('welcome', compact('conference'));
})->name('home');
