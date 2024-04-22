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
}