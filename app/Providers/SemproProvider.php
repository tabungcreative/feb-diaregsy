<?php

namespace App\Providers;

use App\Repositories\Elequent\SemproRepositoryImpl;
use App\Repositories\SemproRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\SemproServiceImpl;
use App\Services\PembayaranService;
use App\Services\SemproService;
use Illuminate\Support\ServiceProvider;

class SemproProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SemproRepository::class, SemproRepositoryImpl::class);
        $this->app->singleton(SemproService::class, function ($app) {
            $semproRepository = $app->make(SemproRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);
            return new SemproServiceImpl($semproRepository, $tahunAjaranRepository, $pembayaranService);
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
