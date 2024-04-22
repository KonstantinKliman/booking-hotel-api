<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\LoginRequest;
use App\Http\Requests\Api\v1\User\RegisterRequest;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    private IUserService $service;

    public function __construct(IUserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->service->register(new UserDTO(
            Arr::get($request->validated(), 'email'),
            Arr::get($request->validated(), 'password')
        ));

        return response()->json([
            'message' => 'User successfully registered.',
            'user' => [
                'id' => $user->id,
                'email' => $user->email
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->service->login(new UserDTO(
            Arr::get($request->validated(), 'email'),
            Arr::get($request->validated(), 'password')
        ));

        return response()->json([
            'message' => 'User successfully logged in.',
            'token' => $token
        ],200);
    }
}
