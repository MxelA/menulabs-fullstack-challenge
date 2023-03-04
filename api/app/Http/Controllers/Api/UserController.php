<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRecourse;
use App\Jobs\UserWeatherUpdateJob;
use App\Repositories\UserRepository\IUserRepository;
use App\Services\WeatherApi\IWeatherApiService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository, IWeatherApiService $openWeatherMapService)
    {
        $this->userRepository = $userRepository;
        $this->openWeatherMapService = $openWeatherMapService;
    }

    public function index(Request $request)
    {
        UserWeatherUpdateJob::dispatch($this->userRepository);
        return UserRecourse::collection(
            $this->userRepository->paginate(
                $request->input('perPage', 15),
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
}
