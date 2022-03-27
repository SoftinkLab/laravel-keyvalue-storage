<?php

namespace SoftinkLab\LaravelKeyvalueStorage\Test;

use SoftinkLab\LaravelKeyvalueStorage\KeyValueStorageServiceProvider;
use Orchestra\Testbench\TestCase;
use SoftinkLab\LaravelKeyvalueStorage\KVOption;

abstract class BaseDBTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('kvstorage.method', 'database');
        $app['config']->set('kvstorage.table_name', 'kv_storage');

        $app['config']->set(
            'database.connections.testbench',
            [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]
        );

        $app->bind('kvoption', KVOption::class);
    }

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            KeyValueStorageServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'KVOption' => KVOption::class,
        ];
    }
}