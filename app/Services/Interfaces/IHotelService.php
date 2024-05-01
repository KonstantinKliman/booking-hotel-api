<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Hotel\CreateHotelRequest;
use App\Http\Requests\Api\v1\Hotel\UpdateHotelRequest;

interface IHotelService
{
    public function create(CreateHotelRequest $request);

    public function getById(int $id);

    public function addImage(array $uploadedFiles, int $id);

    public function deleteImage(int $hotelId, int $imageId);

    public function update(UpdateHotelRequest $request, int $id);

    public function delete(int $id);

    public function list();
}
