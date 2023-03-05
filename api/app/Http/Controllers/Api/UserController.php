<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRecourse;
use App\Repositories\UserRepository\IUserRepository;
use App\Services\WeatherApi\IWeatherApiService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserRecourse::collection(
            $this->userRepository->with('weather')->paginate(
                $request->input('perPage', $request->input('perPage', 5)),
                $request->input('page', 1),
                [
                    'id',
                    'name',
                    'latitude',
                    'longitude',
                    'longitude'
                ]
            )
        );
    }

    public function show($id): UserRecourse
    {
        $user = $this->userRepository
            ->with('weather')
            ->findById($id)
        ;

        return new UserRecourse($user);
    }
}
