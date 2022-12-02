<?php

namespace App\Providers;

use App\Repositories\Elequent\YudisiumRepositoryImpl;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\YudisiumRepository;
use App\Services\Impl\YudisiumServiceImpl;
use App\Services\YudisiumService;
use Illuminate\Support\ServiceProvider;

class YudisiumProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(YudisiumRepository::class, YudisiumRepositoryImpl::class);
        $this->app->singleton(YudisiumService::class, function ($app) {
            $yudisiumRepository = $app->make(YudisiumRepository::class);
            $tahunAjaranRepository = $app->make(TahunAjaranRepository::class);
            return new YudisiumServiceImpl($yudisiumRepository, $tahunAjaranRepository);
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
