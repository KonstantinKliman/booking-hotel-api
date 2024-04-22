<?php

namespace App\Services\Interfaces;

use App\DTO\UserDTO;

interface IUserService
{
    public function register(UserDTO $dto);

    public function login(UserDTO $dto);
}
