<?php

namespace App\Repositories\UserRepository;

use App\Models\Room;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected $model;

    public function __construct(User $room)
    {
        $this->model = $room;
    }
}
