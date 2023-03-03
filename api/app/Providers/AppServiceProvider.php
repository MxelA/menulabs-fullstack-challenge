<?php

namespace App\Providers;

use App\Repositories\UserRepository\IUserRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Services\Weather\IWeatherService;
use App\Services\Weather\OpenWeatherMapService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IWeatherService::class, OpenWeatherMapService::class);
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
