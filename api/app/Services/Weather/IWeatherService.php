<?php

namespace App\Services\Weather;

use App\DTOs\WeatherServiceDto;

interface IWeatherService
{
    public function getWeatherByLatLon(float $lat, float $lon): WeatherServiceDto;
}
