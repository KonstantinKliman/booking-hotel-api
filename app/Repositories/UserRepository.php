<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function get(string $email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getById(int $id)
    {
        return User::query()->findOrFail($id);
    }

    public function save(User $user)
    {
        $user->save();
    }

    public function updateUserRole(int $userId, int $roleId)
    {
        User::query()->where('id', $userId)->update(['role_id' => $roleId]);
    }

    public function update(int $userId, array $data)
    {
        User::query()->where('id', $userId)->update($data);
    }
}
