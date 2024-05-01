<?php

namespace App\Services;

use App\Http\Requests\Api\v1\Hotel\CreateHotelRequest;
use App\Http\Requests\Api\v1\Hotel\UpdateHotelRequest;
use App\Repositories\Interfaces\IHotelRepository;
use App\Repositories\Interfaces\IImageRepository;
use App\Services\Interfaces\IHotelService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HotelService implements IHotelService
{
    private IHotelRepository $repository;
    private IImageRepository $imageRepository;
    private const STORAGE_PATH = 'storage/';
    private const HOTEL_IMAGE_PATH = 'hotel/';

    public function __construct(IHotelRepository $repository, IImageRepository $imageRepository)
    {
        $this->repository = $repository;
        $this->imageRepository = $imageRepository;
    }

    private function getAppUrl(): string
    {
        return config('app.url') . '/';
    }

    public function create(CreateHotelRequest $request)
    {
        $data = [
            'user_id' => $request->user()->id,
            'name' => Arr::get($request->validated(), 'name'),
            'address' => Arr::get($request->validated(), 'address'),
            'star_rating' => Arr::get($request->validated(), 'starRating'),
            'description' => Arr::get($request->validated(), 'description')
        ];

        return $this->repository->create($data);
    }

    public function getById(int $id)
    {
        $hotel = $this->repository->getById($id);
        $images = $hotel->images;
        $rooms = $hotel->rooms;
        return $hotel;
    }

    public function addImage(array $uploadedFiles, int $id)
    {
        $hotel = $this->repository->getById($id);
        $imagePath = self::HOTEL_IMAGE_PATH . $hotel->id;
        $arrayImagePaths = [];

        foreach ($uploadedFiles as $file) {
            $image = $this->imageRepository->create($file->getClientOriginalName(), self::STORAGE_PATH . $imagePath . '/');
            $this->imageRepository->attachHotelToImage($hotel, $image);
            $arrayImagePaths[] = $this->getAppUrl() . self::STORAGE_PATH . Storage::putFileAs($imagePath, $file, $file->getClientOriginalName());
        }

        return $arrayImagePaths;
    }

    public function deleteImage(int $hotelId, int $imageId)
    {
        $hotel = $this->repository->getById($hotelId);
        $image = $this->imageRepository->getImage($imageId);
        $imageFilePath = Str::replace(self::STORAGE_PATH, '', $image->path) . $image->filename;
        Storage::delete($imageFilePath);
        $this->imageRepository->detachHotelFromImage($hotel, $image);
        $this->imageRepository->deleteById($image->id);
    }

    public function update(UpdateHotelRequest $request, int $id)
    {
        $data = array_filter([
            'name' => Arr::get($request->validated(), 'name'),
            'address' => Arr::get($request->validated(), 'address'),
            'star_rating' => Arr::get($request->validated(), 'starRating'),
            'description' => Arr::get($request->validated(), 'description')
        ]);

        $this->repository->update($data, $id);

        return $this->getById($id);
    }

    public function delete(int $id)
    {
        $images = $this->repository->getById($id)->images;

        foreach ($images as $image) {
            $this->imageRepository->delete($image);
        }

        $directory = self::HOTEL_IMAGE_PATH . $id;
        Storage::deleteDirectory($directory);

        $this->repository->delete($id);
        return [
            'message' => 'Hotel successfully deleted.'
        ];
    }

    public function list()
    {
        $hotels = $this->repository->all();
        return $hotels;
    }
}
