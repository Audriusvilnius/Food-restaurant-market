<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CityService;

class CityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(CityService::class, function ($app){
        return new CityService();
        });
    }
}