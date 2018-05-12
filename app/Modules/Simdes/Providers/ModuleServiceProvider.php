<?php

namespace App\Modules\Simdes\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'simdes');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'simdes');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'simdes');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
