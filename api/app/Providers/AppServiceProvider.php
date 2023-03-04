<?php

namespace App\Providers;

use App\Services\User\IUserWeatherService;
use App\Services\User\UserWeatherService;
use App\Services\WeatherApi\IWeatherApiService;
use App\Services\WeatherApi\OpenWeatherMapApiService;
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
        $this->app->bind(IWeatherApiService::class, OpenWeatherMapApiService::class);
        $this->app->bind(IUserWeatherService::class, UserWeatherService::class);
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
