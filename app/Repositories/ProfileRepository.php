<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\Interfaces\IProfileRepository;

class ProfileRepository implements IProfileRepository
{

    public function create(array $data): Profile
    {
        return Profile::firstOrCreate($data);
    }

    public function getById(int $id)
    {
        return Profile::query()->where('id', $id)->first()->toArray();
    }

    public function isExistsById(int $id): bool
    {
        return Profile::where('id', $id)->exists();
    }

    public function update(array $data, int $id): void
    {
        Profile::query()->where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        Profile::destroy($id);
    }
}
