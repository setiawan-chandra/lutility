<?php

namespace Kastanaz\Lutility\Providers;

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
        /**
         * Progress Repository
         */
        $this->app->bind(
            \Kastanaz\Lutility\Contracts\Repositories\ProgressRepositoryContract::class,
            \Kastanaz\Lutility\Repositories\ProgressRepository::class
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
