<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interfaces\ControlRepositoryInterface;
use App\Repository\ControlRepository;
use App\Repository\Interfaces\StripeRepositoryInterface;
use App\Repository\StripeRepository;

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
            ControlRepositoryInterface::class,
            ControlRepository::class
        );
        $this->app->bind(
          StripeRepositoryInterface::class,
          StripeRepository::class
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
