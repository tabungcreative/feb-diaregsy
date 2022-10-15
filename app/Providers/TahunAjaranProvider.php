<?php

namespace App\Providers;

use App\Repositories\Elequent\TahunAjaranRepositoryImpl;
use App\Repositories\TahunAjaranRepository;
use Illuminate\Support\ServiceProvider;

class TahunAjaranProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TahunAjaranRepository::class, TahunAjaranRepositoryImpl::class);
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
