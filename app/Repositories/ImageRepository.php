<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use App\Repositories\Interfaces\IImageRepository;
use Illuminate\Database\Eloquent\Model;

class ImageRepository implements IImageRepository
{

    public function create(string $filename, string $path): Image
    {
        return Image::create(['filename' => $filename, 'path' => $path]);
    }

    public function attachHotelToImage(Hotel $hotel, Image $image)
    {
        $hotel->images()->attach($image);
    }

    public function getImagesToHotel(Hotel $hotel): array
    {
        return $hotel->images->toArray();
    }

    public function detachHotelFromImage(Hotel $hotel, Image $image)
    {
        $hotel->images()->detach($image);
    }

    public function getImage(int $id)
    {
        return Image::query()->where('id', $id)->first();
    }

    public function deleteById(int $id)
    {
        Image::destroy($id);
    }

    public function attachRoomToImage(Room $room, Image $image)
    {
        $room->images()->attach($image);
    }

    public function detachRoomFromImage(Room $room, Image $image)
    {
        $room->images()->detach($image);
    }

    public function delete(Image $image)
    {
        $image->delete();
    }

    public function getByHotelId(int $hotelId)
    {
        return Image::query()
            ->join('hotel_image', 'hotel_image.image_id', '=', 'images.id')
            ->where('hotel_image.hotel_id', $hotelId)
            ->get();
    }
}
