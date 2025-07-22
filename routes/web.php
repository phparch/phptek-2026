<?php

use App\Models\Conference;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $conference = Conference::first();

    return view('single', compact('conference'));
})->name('home');
