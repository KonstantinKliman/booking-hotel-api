<?php

namespace App\Repositories\Interfaces;

use App\Models\Profile;

interface IProfileRepository
{
    public function create(array $data): Profile;

    public function show(int $id);

    public function exists(int $id): bool;
}
