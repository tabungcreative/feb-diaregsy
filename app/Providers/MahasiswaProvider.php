<?php

namespace App\Providers;

use App\Respositories\Api\MahasiswaRepositoryApi;
use App\Respositories\MahasiswaRepository;
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
