<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Room\CreateRoomRequest;
use App\Http\Requests\Api\v1\Room\UpdateRoomRequest;
use App\Services\Interfaces\IRoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private IRoomService $service;

    public function __construct(IRoomService $service)
    {
        $this->service = $service;
    }

    public function create(CreateRoomRequest $request)
    {
         return response()->json($this->service->create($request), 201);
    }

    public function getById(int $roomId)
    {
        return response()->json($this->service->getById($roomId));
    }

    public function update(UpdateRoomRequest $request, int $roomId)
    {
        return response()->json($this->service->update($request, $roomId));
    }

    public function delete(Request $request, int $roomId)
    {
        return response()->json($this->service->delete($request, $roomId));
    }

    public function addImage(Request $request, int $roomId)
    {
        return response()->json($this->service->addImage($request, $roomId));
    }

    public function deleteImage(Request $request, int $roomId, int $imageId)
    {
        return response()->json($this->service->deleteImage($request, $roomId, $imageId));
    }

}
