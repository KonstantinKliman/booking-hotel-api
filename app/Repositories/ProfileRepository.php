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

    public function show(int $id)
    {
        return Profile::query()->where('id', $id)->first()->toArray();
    }

    public function exists(int $id): bool
    {
        return Profile::where('id', $id)->exists();
    }
}
