<?php

namespace Database\Seeders;

use App\Enums\BookingStatusType;
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
        BookingStatus::create(['name' => BookingStatusType::Pending->name]);
        BookingStatus::create(['name' => BookingStatusType::Confirmed->name]);
        BookingStatus::create(['name' => BookingStatusType::Cancelled->name]);
        BookingStatus::create(['name' => BookingStatusType::Completed->name]);
    }
}
