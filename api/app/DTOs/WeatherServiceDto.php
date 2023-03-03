<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class WeatherServiceDto extends Data
{
    public function __construct(
        public readonly float $temp,
        public readonly float $pressure,
        public readonly float $humidity,
        public readonly string $unit
    ){}
}
