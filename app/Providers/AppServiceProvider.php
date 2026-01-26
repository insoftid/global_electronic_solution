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
        // View Composers
        \Illuminate\Support\Facades\View::composer(
            'Admin.Component.Header',
            \App\View\Composers\NotificationComposer::class
        );
    }
}
