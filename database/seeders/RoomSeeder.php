<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::all()->each(function ($hotel) {
            $rooms = Room::factory()->count(3)->create(['hotel_id' => $hotel->id]);

            $rooms->each(function ($room) use ($hotel) {
                $images = Image::factory()->count(3)->create(['path' => 'storage/hotel/' . $hotel->id . '/room/' . $room->id . '/']);
                $room->images()->attach($images->pluck('id')->toArray());
            });
        });
    }
}
