<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;


interface IProfileService
{
    public function create(CreateProfileRequest $request): array;

    public function getById(int $id): array;

    public function update(UpdateProfileRequest $request, int $id);

    public function delete(int $id);
}
