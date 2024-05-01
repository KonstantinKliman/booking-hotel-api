<?php

namespace App\Services;

use App\Http\Requests\Api\v1\Room\CreateRoomRequest;
use App\Http\Requests\Api\v1\Room\UpdateRoomRequest;
use App\Repositories\Interfaces\IImageRepository;
use App\Repositories\Interfaces\IRoomRepository;
use App\Services\Interfaces\IRoomService;
use Illuminate\Support\Arr;
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
            'hotel_id' => Arr::get($request->validated(), 'hotelId'),
            'type_id' => Arr::get($request->validated(), 'typeId'),
            'description' => Arr::get($request->validated(), 'description'),
            'price_per_night' => Arr::get($request->validated(), 'pricePerNight'),
            'is_available' => Arr::get($request->validated(), 'isAvailable')
        ];
        return $this->repository->create($data);
    }

    public function getById(int $roomId)
    {
        $room = $this->repository->getById($roomId);
        $images = $room->images;
        return $room;
    }

    public function update(UpdateRoomRequest $request, int $roomId)
    {
        $data = array_filter([
            'type_id' => Arr::get($request->validated(), 'typeId'),
            'description' => Arr::get($request->validated(), 'description'),
            'count' => Arr::get($request->validated(), 'count'),
            'price_per_night' => Arr::get($request->validated(), 'pricePerNight'),
            'is_available' => Arr::get($request->validated(), 'isAvailable')
        ]);
        $this->repository->update($data, $roomId);
        return $this->getById($roomId);
    }

    public function delete(int $roomId)
    {
        $room = $this->repository->getById($roomId);

        $imageIds = $room->images->pluck('id')->toArray();
        foreach ($imageIds as $imageId) {
            $this->deleteImage($roomId, $imageId);
        }

        $directory = self::HOTEL_IMAGE_PATH . $room->hotel->id . self::ROOM_IMAGE_PATH . $roomId;
        Storage::deleteDirectory($directory);

        $this->repository->delete($roomId);
        return [
            'message' => 'success'
        ];
    }

    private function getAppUrl()
    {
        return config('app.url') . '/';
    }

    public function addImage(array $uploadedFiles, int $id)
    {
        $room = $this->repository->getById($id);
        $imagePath = self::HOTEL_IMAGE_PATH . $room->hotel->id . self::ROOM_IMAGE_PATH . $room->id;
        $arrayImagePaths = [];

        foreach ($uploadedFiles as $file) {
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
