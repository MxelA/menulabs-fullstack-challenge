<?php

namespace App\Repositories\WeatherRepository;

use App\DTOs\WeatherServiceDto;
use App\Models\User;
use App\Models\Weather;
use App\Repositories\IBaseRepository;

interface IWeatherRepository extends IBaseRepository
{
    public function saveWeatherDataFromApiService(User $user, WeatherServiceDto $weatherServiceDto): Weather;
}
