<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\UserServiceInterface;
use App\Services\QualificaApiConnectorInterface;
use App\Services\QualificaApiConnectorService;
use Illuminate\Support\ServiceProvider;

class BindInterfacesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(QualificaApiConnectorInterface::class, QualificaApiConnectorService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
