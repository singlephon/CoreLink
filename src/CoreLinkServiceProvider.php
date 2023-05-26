<?php

namespace Singlephon\Corelink;

use Illuminate\Support\ServiceProvider;
use Singlephon\Corelink\Commands\{CreateServiceCommand, MakeCommand, SyncCommand, InitialStructure};

class CoreLinkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'corelink');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/Models' => app_path('models'),
            ], 'models');
            $this->registerCommands();
        }
    }

    protected function registerCommands(): void
    {
        if (! $this->app->runningInConsole()) return;

        $this->commands([
            InitialStructure::class,
            MakeCommand::class,
            SyncCommand::class,
            CreateServiceCommand::class
        ]);
    }
}
