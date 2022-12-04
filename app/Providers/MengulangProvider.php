<?php

namespace App\Providers;

use App\Repositories\Elequent\MengulangRepositoryImpl;
use App\Repositories\MengulangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\MengulangServiceImpl;
use App\Services\MengulangService;
use App\Services\PembayaranService;
use Illuminate\Support\ServiceProvider;

class MengulangProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MengulangRepository::class, MengulangRepositoryImpl::class);
        $this->app->singleton(MengulangService::class, function ($app) {
            $mengulangRepository = $app->make(MengulangRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);
            return new MengulangServiceImpl($mengulangRepository, $tahunAjaranRepository, $pembayaranService);
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
