<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Repositories\Interfaces\IHotelRepository;

class HotelRepository implements IHotelRepository
{

    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    public function getById(int $id)
    {
        return Hotel::query()->where('id', $id)->first();
    }

    public function getImages(Hotel $hotel)
    {
        return $hotel->images->toArray();
    }

    public function update(array $data, int $id)
    {
        Hotel::query()->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        Hotel::destroy($id);
    }

    public function all()
    {
        return Hotel::all()->toArray();
    }
}
