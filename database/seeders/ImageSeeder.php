<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::all()->each(function ($hotel) {
            $images = Image::factory()->count(5)->create(['path' => 'storage/hotel/' . $hotel->id . '/']);
            $hotel->images()->attach($images->pluck('id')->toArray());
        });
    }
}
