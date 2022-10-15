<?php

namespace App\Providers;

use App\Respositories\Api\PembayaranRepositoryApi;
use App\Respositories\MahasiswaRepository;
use App\Respositories\PembayaranRepository;
use App\Services\Impl\PembayaranServiceImpl;
use App\Services\PembayaranService;
use Illuminate\Support\ServiceProvider;


class PembayaranProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PembayaranRepository::class, PembayaranRepositoryApi::class);
        $this->app->singleton(PembayaranService::class, function ($app) {
            $pembayaranRepository = $app->make(PembayaranRepository::class);
            $mahasiswaRepository = $app->make(MahasiswaRepository::class);
            return new PembayaranServiceImpl($pembayaranRepository, $mahasiswaRepository);
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
