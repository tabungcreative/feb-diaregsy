<?php

namespace App\Providers;

use App\Repositories\Api\MahasiswaRepositoryApi;
use App\Repositories\MahasiswaRepository;
use App\Services\Impl\MahasiswaServiceImpl;
use App\Services\MahasiswaService;
use Illuminate\Support\ServiceProvider;

class MahasiswaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MahasiswaRepository::class, MahasiswaRepositoryApi::class);
        $this->app->singleton(MahasiswaService::class, function ($app) {
            $mahasiswaRepository = $app->make(MahasiswaRepository::class);
            return new MahasiswaServiceImpl($mahasiswaRepository);
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
