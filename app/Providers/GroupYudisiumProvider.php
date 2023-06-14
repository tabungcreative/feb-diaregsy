<?php

namespace App\Providers;

use App\Repositories\Elequent\GroupYudisiumRepositoryImpl;
use App\Repositories\GroupYudisiumRepository;
use App\Services\GroupYudisiumService;
use App\Services\Impl\GroupYudisiumServiceImpl;
use Illuminate\Support\ServiceProvider;

class GroupYudisiumProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GroupYudisiumRepository::class, GroupYudisiumRepositoryImpl::class);
        $this->app->singleton(GroupYudisiumService::class, function ($app) {
            $groupYudisiumRepository = $app->make(GroupYudisiumRepository::class);
            return new GroupYudisiumServiceImpl($groupYudisiumRepository);
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
