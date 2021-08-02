<?php

namespace App\Providers;

use App\Repositories\Interfaces\DrinkRepositoryInterface;
use App\Services\DrinksService;
use Illuminate\Support\ServiceProvider;

class DrinksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\PlacesService', function ($app) {
            return new DrinksService(
                $app->make(DrinkRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
