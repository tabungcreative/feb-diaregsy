<?php

namespace App\Providers;

use App\Repositories\Api\DosenRepositoryApi;
use App\Repositories\DosenRepository;
use Illuminate\Support\ServiceProvider;

class DosenProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DosenRepository::class, DosenRepositoryApi::class);
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
