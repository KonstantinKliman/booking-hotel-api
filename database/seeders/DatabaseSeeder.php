<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RoomTypeSeeder::class,
            BookingStatusesSeeder::class,
            PaymentStatusesSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            HotelSeeder::class,
            ImageSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
