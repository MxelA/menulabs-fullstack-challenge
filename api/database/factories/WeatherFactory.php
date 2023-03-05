<?php

namespace Database\Factories;

use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class WeatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'temp' => fake()->randomFloat(2,-999, 999),
            'unit' => fake()->randomElement([Weather::UNIT_DEFAULT, Weather::UNIT_IMPERIAL, Weather::UNIT_METRIC]),
            'pressure'=> fake()->randomFloat(2,-999, 999),
            'humidity'=> fake()->randomFloat(2,-999, 999)
        ];
    }
}
