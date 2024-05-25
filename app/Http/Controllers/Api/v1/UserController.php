<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Services\Interfaces\IUserService;

class UserController extends Controller
{
    private IUserService $service;

    public function __construct(IUserService $service)
    {
        $this->service = $service;
    }

    public function getById(int $userId)
    {
        return response()->json($this->service->getById($userId));
    }

    public function update(int $userId, UpdateUserRequest $request)
    {
        return response()->json($this->service->update($userId, $request));
    }
}
