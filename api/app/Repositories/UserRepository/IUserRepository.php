<?php

namespace App\Repositories\UserRepository;

use App\Repositories\IBaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository extends IBaseRepository
{
    public function getUsersThatNeedToUpdateWeatherData(int $perPage, int $page): LengthAwarePaginator;
}
