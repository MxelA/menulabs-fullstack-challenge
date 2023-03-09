<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPaginationRequest;
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

    public function index(UserPaginationRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //dd($request->input('perPage'));
        return UserRecourse::collection(
            $this->userRepository->with('weather')->paginate(
                $request->input('perPage', $request->input('perPage')),
                $request->input('page'),
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
