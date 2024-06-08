<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Api\v1\Room\CreateRoomRequest;
use App\Http\Requests\Api\v1\Room\UpdateRoomRequest;
use App\Http\Resources\Api\v1\RoomResource;
use App\Repositories\Interfaces\IImageRepository;
use App\Repositories\Interfaces\IRoomRepository;
use App\Services\Interfaces\IRoomService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomService implements IRoomService
{
    private IRoomRepository $repository;
    private IImageRepository $imageRepository;
    private const string STORAGE_PATH = 'storage/';
    private const string HOTEL_IMAGE_PATH = 'hotel/';
    private const string ROOM_IMAGE_PATH = '/room/';

    public function __construct(IRoomRepository $repository, IImageRepository $imageRepository)
    {
        $this->repository = $repository;
        $this->imageRepository = $imageRepository;
    }

    public function create(CreateRoomRequest $request)
    {
        $data = [
            'hotel_id' => $request->validated('hotelId'),
            'type_id' => $request->validated('typeId'),
            'description' => $request->validated('description'),
            'price_per_night' => $request->validated('pricePerNight'),
            'is_available' => $request->validated('isAvailable')
        ];

        $room = $this->repository->create($data);

        return new RoomResource($room);
    }

    public function getById(int $roomId)
    {
        try {
            $room = $this->repository->getById($roomId);
            return new RoomResource($room);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        }
    }

    public function update(UpdateRoomRequest $request, int $roomId)
    {
        $data = array_filter([
            'type_id' => $request->validated('typeId'),
            'description' => $request->validated('description'),
            'price_per_night' => $request->validated('pricePerNight'),
            'is_available' => $request->validated('isAvailable')
        ]);

        $this->repository->update($data, $roomId);

        return $this->getById($roomId);
    }

    public function delete(Request $request, int $roomId)
    {
        $room = $this->repository->getById($roomId);
        $imageIds = $room->images->pluck('id')->toArray();
        foreach ($imageIds as $imageId) {
            $this->deleteImage($roomId, $imageId);
        }

        $directory = self::HOTEL_IMAGE_PATH . $room->hotel->id . self::ROOM_IMAGE_PATH . $roomId;
        Storage::deleteDirectory($directory);

        $this->repository->delete($roomId);
        return null;
    }

    private function getAppUrl()
    {
        return config('app.url') . '/';
    }

    public function addImage(Request $request, int $id)
    {
        $room = $this->repository->getById($id);
        $imagePath = self::HOTEL_IMAGE_PATH . $room->hotel->id . self::ROOM_IMAGE_PATH . $room->id;
        $arrayImagePaths = [];

        foreach ($request->file() as $file) {
            $image = $this->imageRepository->create($file->getClientOriginalName(), self::STORAGE_PATH . $imagePath . '/');
            $this->imageRepository->attachRoomToImage($room, $image);
            $arrayImagePaths[] = $this->getAppUrl() . self::STORAGE_PATH . Storage::putFileAs($imagePath, $file, $file->getClientOriginalName());
        }

        return $arrayImagePaths;
    }

    public function deleteImage(int $roomId, int $imageId)
    {
        $room = $this->repository->getById($roomId);
        $image = $this->imageRepository->getImage($imageId);
        $imageFilePath = Str::replace(self::STORAGE_PATH, '', $image->path) . $image->filename;
        Storage::delete($imageFilePath);
        $this->imageRepository->detachRoomFromImage($room, $image);
        $this->imageRepository->deleteById($image->id);
    }
}
