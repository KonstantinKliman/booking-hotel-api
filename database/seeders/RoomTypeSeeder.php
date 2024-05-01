<?php

namespace Database\Seeders;

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
        RoomType::create(['name' => 'single']);
        RoomType::create(['name' => 'double']);
        RoomType::create(['name' => 'twin']);
        RoomType::create(['name' => 'suite']);
        RoomType::create(['name' => 'standard']);
        RoomType::create(['name' => 'family']);
    }
}
