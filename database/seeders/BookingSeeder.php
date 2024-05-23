<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->where('role_id', RoleType::Customer->value)->each(function ($user) {
            Booking::factory()->count(1)->create(['user_id' => $user->id]);
        });
    }
}
