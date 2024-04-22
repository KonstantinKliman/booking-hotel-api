<?php

namespace App\Repositories\Interfaces;

interface IUserRepository
{
    public function create(array $data);

    public function get(string $email);
}
