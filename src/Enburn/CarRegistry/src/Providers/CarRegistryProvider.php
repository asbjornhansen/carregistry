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
