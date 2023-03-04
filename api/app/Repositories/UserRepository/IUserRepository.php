<?php

namespace App\Repositories\UserRepository;

use App\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository extends IBaseRepository
{
    public function getUsersThatNeedToUpdateWeatherData(int $takeUsers): Collection;
}
