<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\IBookingRepository;

class BookingRepository implements IBookingRepository
{
    public function create(array $data)
    {
        return Booking::query()->create($data);
    }

    public function getById(int $id)
    {
        return Booking::query()->where('id', $id)->firstOrFail();
    }

    public function update(array $data, int $id)
    {
        Booking::query()->where('id', $id)->update($data);
    }

    public function all()
    {
        return Booking::all();
    }

    public function getForCustomer(int $userId)
    {
        return Booking::query()->where('user_id', $userId)->get();
    }

    public function delete(int $id)
    {
        Booking::query()->where('id', $id)->delete();
    }

    public function getForOwner(int $userId)
    {
        return Booking::query()
            ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->join('hotels', 'rooms.hotel_id', '=', 'hotels.id')
            ->where('hotels.user_id', '=', $userId)
            ->select('bookings.*')
            ->get();
    }
}
