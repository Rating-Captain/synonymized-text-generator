<?php

namespace RatingCaptain\SynonymizedTextGenerator;

use Illuminate\Support\ServiceProvider;

class SynonymizedTextGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('synonymized-text-generatorphp'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'synonymized-text-generator');

        // Register the main class to use with the facade
        $this->app->singleton('synonymized-text-generator', function () {
            return new SynonymizedTextGenerator;
        });
    }
}
