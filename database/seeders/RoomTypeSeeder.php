<?php

namespace Database\Seeders;

use App\Enums\RoomType as RoomTypeEnum;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create(['name' => RoomTypeEnum::Single->name]);
        RoomType::create(['name' => RoomTypeEnum::Double->name]);
        RoomType::create(['name' => RoomTypeEnum::Twin->name]);
        RoomType::create(['name' => RoomTypeEnum::Suite->name]);
        RoomType::create(['name' => RoomTypeEnum::Standard->name]);
        RoomType::create(['name' => RoomTypeEnum::Family->name]);
    }
}
