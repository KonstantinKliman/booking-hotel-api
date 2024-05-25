<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;

interface IAuthService
{

    public function register(RegisterRequest $request): array;

    public function login(LoginRequest $request): array;

}
