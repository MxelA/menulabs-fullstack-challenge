<?php

namespace App\Services\WeatherApi;

use App\DTOs\WeatherServiceDto;

interface IWeatherApiService
{
    public function getWeatherByLatLon(float $lat, float $lon): WeatherServiceDto;
}
