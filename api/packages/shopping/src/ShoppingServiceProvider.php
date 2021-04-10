<?php

namespace SHOP\Shopping;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ShoppingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::group([
            'namespace' => 'SHOP\Shopping\Controllers',
            'prefix'    => 'api/shopping'
        ], function() {
            $this->loadRoutesFrom(__DIR__ . '/routes.php');
        });
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
