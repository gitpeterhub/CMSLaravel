<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //for Issue.
        $this->app->bind(
            'App\Repositories\Contracts\RepositoryInterface',
            'App\Repositories\Eloquent\Repository'
        );

         $this->app->bind(
            'App\Repositories\Eloquent\Repository',
            'App\Repositories\UserRepository'
        );
    }
}
