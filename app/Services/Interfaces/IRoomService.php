<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Room\CreateRoomRequest;
use App\Http\Requests\Api\v1\Room\UpdateRoomRequest;

interface IRoomService
{
    public function create(CreateRoomRequest $request);

    public function getById(int $roomId);

    public function update(UpdateRoomRequest $request, int $roomId);

    public function delete(int $roomId);

    public function addImage(array $uploadedFiles, int $id);

    public function deleteImage(int $roomId, int $imageId);
}
