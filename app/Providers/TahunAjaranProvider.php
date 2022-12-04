<?php

namespace App\Providers;

use App\Repositories\Elequent\TahunAjaranRepositoryImpl;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\TahunAjaranServiceImpl;
use App\Services\TahunAjaranService;
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
            $this->app->singleton(TahunAjaranService::class, function ($app) {
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            return new TahunAjaranServiceImpl( $tahunAjaranRepository);
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
