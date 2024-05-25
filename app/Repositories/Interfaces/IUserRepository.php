<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function create(array $data);

    public function get(string $email);

    public function getById(int $id);

    public function save(User $user);

    public function updateUserRole(int $userId, int $roleId);

    public function update(int $userId, array $data);
}
