<?php

namespace App\Services;

use App\Http\Requests\Api\v1\Hotel\CreateHotelRequest;
use App\Http\Requests\Api\v1\Hotel\UpdateHotelRequest;
use App\Http\Resources\Api\v1\HotelCollection;
use App\Http\Resources\Api\v1\HotelResource;
use App\Http\Resources\Api\v1\ImageCollection;
use App\Http\Resources\Api\v1\ImageResource;
use App\Models\Hotel;
use App\Models\Image;
use App\Repositories\Interfaces\IHotelRepository;
use App\Repositories\Interfaces\IImageRepository;
use App\Services\Interfaces\IHotelService;
use Illuminate\Http\Request;
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
        $data = array(
            'user_id' => $request->user()->id,
            'name' => $request->validated('name'),
            'address' => $request->validated('address'),
            'star_rating' => $request->validated('starRating'),
            'description' => $request->validated('description')
        );

        $hotel = $this->repository->create($data);

        return new HotelResource($hotel);
    }

    public function getById(int $id)
    {
        $hotel = $this->repository->getById($id);

        return new HotelResource($hotel);
    }

    public function update(UpdateHotelRequest $request, int $id)
    {
        $data = array_filter([
            'name' => $request->validated('name'),
            'address' => $request->validated('address'),
            'star_rating' => $request->validated('starRating'),
            'description' => $request->validated('description')
        ]);

        $this->repository->update($data, $id);

        return $this->getById($id);
    }

    public function delete(int $id)
    {
        $images = $this->imageRepository->getByHotelId($id);

        foreach ($images as $image) {
            $this->imageRepository->delete($image);
        }

        $directory = self::HOTEL_IMAGE_PATH . $id;
        Storage::deleteDirectory($directory);

        $this->repository->delete($id);
    }

    public function list()
    {
        $hotels = $this->repository->paginate();

        return new HotelCollection($hotels);
    }

    /*
     * TODO: Необходимо вернуть JSON строку в виде:
     * {
     *      [
     *          "id" : 1,
     *          "url" : imageUrl1
     *      ],
     *      [
     *          "id": 2,
     *          "url": imageUrl2
     *      ]
     * }
     *
     */
    public function addImage(Request $request, int $hotelId)
    {
        $hotel = $this->repository->getById($hotelId);
        $imagePath = self::HOTEL_IMAGE_PATH . $hotel->id;

        foreach ($request->file() as $file) {
            $image = $this->imageRepository->create($file->getClientOriginalName(), self::STORAGE_PATH . $imagePath . '/');
            $this->imageRepository->attachHotelToImage($hotel, $image);
        }


        return ImageResource::collection($hotel->images);
    }

    public function deleteImage(Request $request, int $hotelId, int $imageId)
    {
        $hotel = $this->repository->getById($hotelId);
        $image = $this->imageRepository->getImage($imageId);
        $imageFilePath = Str::replace(self::STORAGE_PATH, '', $image->path) . $image->filename;
        Storage::delete($imageFilePath);
        $this->imageRepository->detachHotelFromImage($hotel, $image);
        $this->imageRepository->deleteById($image->id);
    }
}
