<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS (you already added this)
        \Illuminate\Support\Facades\URL::forceScheme('https');

        // Add this NEW line to force the domain:
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
    }
}
