<?php

namespace App\Repositories\WeatherRepository;

use App\DTOs\WeatherServiceDto;
use App\Models\User;
use App\Models\Weather;
use App\Repositories\BaseRepository;

class WeatherRepository extends BaseRepository implements IWeatherRepository
{
    public function __construct(Weather $weather)
    {
        $this->model = $weather;
    }

    public function saveWeatherDataFromApiService(User $user, WeatherServiceDto $weatherServiceDto): Weather
    {
        return $this->model->updateOrCreate([
            'user_id'       => $user->id,
            'temp'          => $weatherServiceDto->temp,
            'temp_unit'     => $weatherServiceDto->unit,
            'pressure'      => $weatherServiceDto->pressure,
            'humidity'      => $weatherServiceDto->humidity
        ]);
    }

}
