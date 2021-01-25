<?php

namespace Zorb\BOGConsole;

use Illuminate\Support\ServiceProvider;

class BOGConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/bog-console.php' => config_path('bog-console.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/config/bog-console.php', 'bog-console');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BOGConsole::class);
    }
}
