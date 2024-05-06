<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingStatus::create(['name' => 'pending']);
        BookingStatus::create(['name' => 'confirmed']);
        BookingStatus::create(['name' => 'cancelled']);
        BookingStatus::create(['name' => 'completed']);
    }
}
