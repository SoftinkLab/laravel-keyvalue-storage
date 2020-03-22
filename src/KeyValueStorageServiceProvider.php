<?php

namespace SoftinkLab\LaravelKeyvalueStorage;

use Illuminate\Support\ServiceProvider;

class KeyValueStorageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Database Table
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Configurations
        $this->publishes([
            __DIR__ . '/../config/kvstorage.php' => config_path('kvstorage.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('kvoption', KVOption::class);
    }
}