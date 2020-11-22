<?php

namespace Enburn\CarRegistry\Providers;

use Illuminate\Support\ServiceProvider;

class CarRegistryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'vr');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // booti
    }
}
