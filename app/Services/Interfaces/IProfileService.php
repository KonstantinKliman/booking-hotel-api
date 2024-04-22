<?php

namespace App\Services\Interfaces;

use App\DTO\ProfileDTO;


interface IProfileService
{
    public function store(ProfileDTO $dto, int $userId);

    public function show(int $id);

    public function update(int $id);
}
