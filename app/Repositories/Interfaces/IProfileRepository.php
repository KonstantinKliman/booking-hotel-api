<?php

namespace App\Repositories\Interfaces;

use App\Models\Profile;

interface IProfileRepository
{
    public function create(array $data): Profile;

    public function getById(int $id);

    public function isExistsById(int $id): bool;

    public function update(array $data, int $id);

    public function delete(int $id): void;
}
