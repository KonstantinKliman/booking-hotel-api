<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Services\Interfaces\IAuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private IAuthService $service;

    public function __construct(IAuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->service->register($request), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json($this->service->login($request));
    }
}
