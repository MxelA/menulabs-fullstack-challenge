<?php

namespace App\Services\User;

use App\Exceptions\WeatherApiServiceErrorException;
use App\Models\User;
use App\Repositories\WeatherRepository\IWeatherRepository;
use App\Services\WeatherApi\IWeatherApiService;

class UserWeatherService implements IUserWeatherService
{

    private IWeatherApiService $weatherService;
    private IWeatherRepository $weatherRepository;

    public function __construct(IWeatherApiService $weatherService, IWeatherRepository $weatherRepository)
    {
        $this->weatherService = $weatherService;
        $this->weatherRepository = $weatherRepository;
    }

    public function updateUserWeather(User $user):bool
    {
        try {
            $weatherData = $this->weatherService->getWeatherByLatLon($user->latitude, $user->longitude);
            $this->weatherRepository->saveWeatherDataFromApiService($user, $weatherData);
        } catch (WeatherApiServiceErrorException $e) {
            return false;
        }

        return true;
    }
}
