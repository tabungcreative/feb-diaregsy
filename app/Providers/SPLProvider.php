<?php

namespace App\Providers;

use App\Repositories\Elequent\SPLRepositoryImpl;
use App\Repositories\SPLRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\Impl\SPLServiceImpl;
use App\Services\PembayaranService;
use App\Services\SPLService;
use Illuminate\Support\ServiceProvider;

class SPLProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SPLRepository::class, SPLRepositoryImpl::class);
        $this->app->singleton(SPLService::class, function ($app) {
            $splRepository = $app->make(SPLRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            $pembayaranService = $app->make(PembayaranService::class);

            return new SPLServiceImpl($splRepository, $tahunAjaranRepository, $pembayaranService);
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
