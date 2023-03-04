<?php

namespace App\Providers;

use App\Repositories\UserRepository\IUserRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\WeatherRepository\IWeatherRepository;
use App\Repositories\WeatherRepository\WeatherRepository;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
        /**
     * Register any events for your application.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IWeatherRepository::class, WeatherRepository::class);
    }
}
