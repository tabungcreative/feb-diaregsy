<?php

namespace App\Providers;

use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\Elequent\BimbinganSkripsiRepositoryImpl;
use App\Repositories\TahunAjaranRepository;
use App\Services\BimbinganSkripsiService;
use App\Services\Impl\BimbinganSkripsiServiceImpl;
use App\Services\PembayaranService;
use Illuminate\Support\ServiceProvider;

class BimbinganSkripsiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BimbinganSkripsiRepository::class, BimbinganSkripsiRepositoryImpl::class);
        $this->app->singleton(BimbinganSkripsiService::class, function ($app) {
            $bimbinganSkripsiRepository = $app->make(BimbinganSkripsiRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);

            return new BimbinganSkripsiServiceImpl($bimbinganSkripsiRepository, $tahunAjaranRepository, $pembayaranService);
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
