<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\LoginRequest;
use App\Http\Requests\Api\v1\User\RegisterRequest;
use App\Http\Requests\Api\v1\User\ResendEmailVerificationLinkRequest;
use App\Http\Requests\Api\v1\User\VerifyEmailRequest;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $service;

    public function __construct(IUserService $service)
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
