<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsersThatNeedToUpdateWeatherData(int $takeUsers): Collection
    {
        return $this->model
            ->leftJoin('weathers', 'users.id', '=', 'weathers.user_id')
            ->select(['users.id', 'users.latitude', 'users.latitude', 'longitude'])
            ->where(function ($query){
                $query->where('weathers.updated_at','<=', Carbon::now()->addMinutes(-30))
                    ->orWhere('weathers.updated_at', '=', null);
            })
            ->skip(0)
            ->take($takeUsers)
            ->get()
        ;
    }
}
