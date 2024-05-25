<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Http\Requests\Api\v1\Auth\ResendEmailVerificationLinkRequest;
use App\Http\Requests\Api\v1\Auth\VerifyEmailRequest;
use App\Http\Requests\Api\v1\User\UpdateUserRequest;

interface IUserService
{

    public function getById(int $id);

    public function update(int $userId, UpdateUserRequest $request);
}
