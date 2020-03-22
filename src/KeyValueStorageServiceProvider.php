<?php

namespace SoftinkLab\LaravelKeyvalueStorage;

use Illuminate\Support\ServiceProvider;

class KeyValueStorageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {

    }
}