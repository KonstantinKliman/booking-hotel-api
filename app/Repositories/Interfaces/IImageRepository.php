<?php

namespace App\Repositories\Interfaces;

use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;

interface IImageRepository
{
    public function create(string $filename, string $path);

    public function attachHotelToImage(Hotel $hotel, Image $image);

    public function getImagesToHotel(Hotel $hotel): array;

    public function detachHotelFromImage(Hotel $hotel, Image $image);

    public function attachRoomToImage(Room $room, Image $image);

    public function detachRoomFromImage(Room $room, Image $image);

    public function getImage(int $id);

    public function deleteById(int $id);

    public function delete(Image $image);

    public function getByHotelId(int $hotelId);
}
