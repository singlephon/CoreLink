<?php

namespace Singlephon\Corelink;

use Illuminate\Support\ServiceProvider;
use Singlephon\Corelink\Commands\{
    InitialStructure,
    MakeCommand,
    SyncCommand
};

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
            __DIR__.'/../stubs' => base_path('stubs'),
        ], 'stubs');
        $this->publishes([
            __DIR__.'/Models' => app_path('models'),
        ], 'models');
        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        if (! $this->app->runningInConsole()) return;

        $this->commands([
            InitialStructure::class,
            MakeCommand::class,
            SyncCommand::class
        ]);
    }
}
