<?php

namespace App\Providers;

use App\Services\InvestmentInterface;
use App\Services\InvestmentService;
use App\Services\InvestorInterface;
use App\Services\InvestorService;
use App\Services\UserService;
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
        $this->app->bind(UserServic::class, UserService::class);
    }
}