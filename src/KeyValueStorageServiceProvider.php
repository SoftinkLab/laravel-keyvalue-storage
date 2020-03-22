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

        //Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\KeyValueStorageCommand::class,
                Console\KeyValueDeleteCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('kvoption', KVOption::class);

        $this->registerHelpers();
    }

    /**
     * Register helpers file
     */
    public function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '\Http\helpers.php')) {
            require_once $file;
        }
    }
}