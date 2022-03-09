<?php

namespace ExclusiveDev\FileLeech\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use ExclusiveDev\FileLeech\Contracts\Attachable;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot()
    {
        $this->app->bind(
            Attachable::class
        );

        /**
         * Publishers
         */
        $this->publishes([
            __DIR__ . '/../../config/attachments.php' => config_path('attachments.php'),
        ], 'config');

        /**
         * Load some stuff
         */
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');        
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');        
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/attachments.php',
            'attachments'
        );
    }
}