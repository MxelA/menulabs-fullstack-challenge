<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRecourse;
use App\Repositories\UserRepository\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return UserRecourse::collection($this->userRepository->paginate($request->input('perPage', 15), $request->input('page', 1)));
    }
}
