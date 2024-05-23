<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Hotel;
use App\Models\User;
use Database\Factories\HotelFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->where('role_id', RoleType::Owner->value)->each(function ($owner) {
            Hotel::factory()->count(3)->create(['user_id' => $owner->id]);
        });
    }
}
