<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BasketService;

class BasketServiceProvider extends ServiceProvider
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
        $this->app->singleton(BasketService::class, function ($app){
        return new BasketService();
        });

    }
}