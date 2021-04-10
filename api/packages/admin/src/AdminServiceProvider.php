<?php

namespace SHOP\Admin;

use Illuminate\Support\ServiceProvider;
use SHOP\Admin\Models\AdminConfig;
use SHOP\Admin\Observers\AdminConfigObserver;
use Illuminate\Support\Facades\Route;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::group([
            'namespace' => 'SHOP\Admin\Controllers',
            'prefix'    => 'api/admin'
        ], function() {
            $this->loadRoutesFrom(__DIR__ . '/routes.php');
        });

        AdminConfig::observe(AdminConfigObserver::class);
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
