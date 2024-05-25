<?php

namespace App\Repositories\Interfaces;

use App\Models\Hotel;

interface IHotelRepository
{
    public function create(array $data);

    public function getById(int $id);

    public function getImages(Hotel $hotel);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function all();

    public function paginate(int $perPage = 10);
}
