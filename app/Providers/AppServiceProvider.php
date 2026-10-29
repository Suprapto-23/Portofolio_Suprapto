<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa HTTPS saat diakses lewat ngrok / domain HTTPS
        if (str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}