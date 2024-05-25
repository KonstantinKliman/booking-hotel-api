<?php

namespace App\Services;

use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getById(int $id)
    {
        try {
            $user = $this->repository->getById($id);
            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

    }


    public function update(int $userId, UpdateUserRequest $request)
    {
        $data = array_filter([
            'email' => $request->validated('email'),
            'password' => $request->validated('password') == null ? null : Hash::make($request->validated('password')),
        ]);

        $this->repository->update($userId, $data);
        $user = $this->repository->getById($userId);


        return new UserResource($user);
    }
}
