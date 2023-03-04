<?php

namespace App\Repositories\WeatherRepository;

use App\Models\Weather;
use App\Repositories\BaseRepository;

class WeatherRepository extends BaseRepository implements IWeatherRepository
{
    public function __construct(Weather $weather)
    {
        $this->model = $weather;
    }

}
