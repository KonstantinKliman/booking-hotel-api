<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\IRoomRepository;

class RoomRepository implements IRoomRepository
{

    public function create(array $data)
    {
        return Room::query()->create($data);
    }

    public function getById(int $id)
    {
        return Room::query()->where('id', $id)->first();
    }

    public function update(array $data, int $id)
    {
        return Room::query()->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        Room::destroy($id);
    }
}
