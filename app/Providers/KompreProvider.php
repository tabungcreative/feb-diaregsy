<?php

namespace App\Providers;

use App\Repositories\Elequent\KompreRepositoryImpl;
use App\Repositories\KompreRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\KompreServiceImpl;
use App\Services\KompreService;
use Illuminate\Support\ServiceProvider;

class KompreProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(KompreRepository::class, KompreRepositoryImpl::class);
        $this->app->singleton(KompreService::class, function ($app) {
            $kompreRepository = $app->make(KompreRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            return new KompreServiceImpl($kompreRepository, $tahunAjaranRepository);
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
