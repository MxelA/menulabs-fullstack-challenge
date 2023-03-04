<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsersThatNeedToUpdateWeatherData(int $perPage, int $page): LengthAwarePaginator
    {
        $this->model->whereHas('weather', function (Builder $query) {
            return $query->where('updated_at', '<', Carbon::now()->subHours(1));
        });
        return $this->paginate($perPage, $page, ['latitude', 'longitude']);
    }
}
