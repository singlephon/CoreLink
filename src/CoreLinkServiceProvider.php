<?php

namespace Singlephon\Corelink;

use Illuminate\Support\ServiceProvider;

class CoreLinkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        include __DIR__ . '/Routes/default.php';
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__.'/Structure' => app_path('CoreLink'),
        ], 'app');
    }
}
