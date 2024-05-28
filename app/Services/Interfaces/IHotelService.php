<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Hotel\CreateHotelRequest;
use App\Http\Requests\Api\v1\Hotel\UpdateHotelRequest;
use Illuminate\Http\Request;

interface IHotelService
{
    public function create(CreateHotelRequest $request);

    public function getById(int $id);

    public function addImage(Request $request, int $hotelId);

    public function deleteImage(Request $request, int $hotelId, int $imageId);

    public function update(UpdateHotelRequest $request, int $id);

    public function delete(int $id);

    public function list();
}
