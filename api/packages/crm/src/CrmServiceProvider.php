<?php

namespace SHOP\CRM;

use Illuminate\Support\ServiceProvider;
use Route;

class CrmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::group([
            'namespace' => 'SHOP\CRM\Controllers',
            'prefix'    => 'api/crm'
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
