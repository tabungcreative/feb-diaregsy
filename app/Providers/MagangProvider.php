<?php

namespace App\Providers;

use App\Repositories\Elequent\MagangRepositoryImpl;
use App\Repositories\MagangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\MagangServiceImpl;
use App\Services\MagangService;
use App\Services\PembayaranService;
use Illuminate\Support\ServiceProvider;

class MagangProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MagangRepository::class, MagangRepositoryImpl::class);
        $this->app->singleton(MagangService::class, function ($app) {
            $magangRepository = $app->make(MagangRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);

            return new MagangServiceImpl($magangRepository, $tahunAjaranRepository, $pembayaranService);
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
