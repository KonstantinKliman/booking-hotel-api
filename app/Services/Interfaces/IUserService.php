<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\User\LoginRequest;
use App\Http\Requests\Api\v1\User\RegisterRequest;
use App\Http\Requests\Api\v1\User\ResendEmailVerificationLinkRequest;
use App\Http\Requests\Api\v1\User\VerifyEmailRequest;

interface IUserService
{
    public function register(RegisterRequest $request): array;

    public function login(LoginRequest $request): array;

    public function verifyUserEmail(VerifyEmailRequest $request);

    public function resendVerificationLink(ResendEmailVerificationLinkRequest $request);
}
