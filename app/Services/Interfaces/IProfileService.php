<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;
use App\Http\Resources\Api\v1\ProfileResource;


interface IProfileService
{
    public function create(CreateProfileRequest $request);

    public function getById(int $id);

    public function update(UpdateProfileRequest $request, int $id);

    public function delete(int $id);
}
