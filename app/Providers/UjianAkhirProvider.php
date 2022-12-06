<?php

namespace App\Providers;

use App\Repositories\Elequent\UjianAkhirRepositoryImpl;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\Impl\UjianAkhirServiceImpl;
use App\Services\PembayaranService;
use App\Services\UjianAkhirService;
use Illuminate\Support\ServiceProvider;

class UjianAkhirProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UjianAkhirRepository::class, UjianAkhirRepositoryImpl::class);
        $this->app->singleton(UjianAkhirService::class, function ($app) {
            $ujianAkhirRepository = $app->make(UjianAkhirRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);

            return new UjianAkhirServiceImpl($ujianAkhirRepository, $tahunAjaranRepository, $pembayaranService);
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
