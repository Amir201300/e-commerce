<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ReposatryProvider extends ServiceProvider
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
        $this->app->bind(
            'App\Interfaces\HandleDataInterface',
            'App\Reposatries\HandleDataReposatry'
        );

        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Reposatries\UserReposatry'
        );
    }
}
