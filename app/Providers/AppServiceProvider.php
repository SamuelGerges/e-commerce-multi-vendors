<?php

namespace App\Providers;

use App\Adpaters\implementation\VictoryLinkSMS;
use App\Adpaters\ISMS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        //laravel container

        //Ioc container

        //dependency manager

        $this->app->bind(ISMS::class,VictoryLinkSMS::class);

        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('basket');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
