<?php

namespace App\Providers;

use App\Repositories\DrinkRepository;
use App\Repositories\Interfaces\DrinkRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            DrinkRepositoryInterface::class, 
            DrinkRepository::class
        );
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
