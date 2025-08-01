<?php

namespace App\Providers;

use App\Models\Conference;
use Illuminate\Support\ServiceProvider;

class ConferenceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('conference', function () {
            $uuid = config('tek.conference.uuid');

            return Conference::where('uuid', $uuid)->first();
        });
    }

    public function boot(): void
    {
        //
    }
}
