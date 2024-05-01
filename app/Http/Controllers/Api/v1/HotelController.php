<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Hotel\CreateHotelRequest;
use App\Http\Requests\Api\v1\Hotel\UpdateHotelRequest;
use App\Services\Interfaces\IHotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    private IHotelService $service;

    public function __construct(IHotelService $service)
    {
        $this->service = $service;
    }

    public function create(CreateHotelRequest $request)
    {
        return response()->json($this->service->create($request), 201);
    }

    public function getById(int $id)
    {
        return response()->json($this->service->getById($id));
    }

    public function list()
    {
        return response()->json($this->service->list());
    }

    public function addImage(Request $request, int $id)
    {
        return response()->json($this->service->addImage($request->file(), $id));
    }

    public function deleteImage(int $hotelId, int $imageId)
    {
        return response()->json($this->service->deleteImage($hotelId, $imageId));
    }

    public function update(UpdateHotelRequest $request, int $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function delete(int $id)
    {
        return response()->json($this->service->delete($id));
    }
}
