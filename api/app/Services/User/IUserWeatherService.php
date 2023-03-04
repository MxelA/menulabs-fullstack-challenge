<?php

namespace App\Services\User;

use App\Models\User;

interface IUserWeatherService
{
    public function updateUserWeather(User $user): bool;
}
