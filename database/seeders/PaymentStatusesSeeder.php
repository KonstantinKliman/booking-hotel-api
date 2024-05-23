<?php

namespace Database\Seeders;

use App\Enums\PaymentStatusType;
use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentStatus::create(['name' => PaymentStatusType::Pending->name]);
        PaymentStatus::create(['name' => PaymentStatusType::Paid->name]);
        PaymentStatus::create(['name' => PaymentStatusType::Failed->name]);
    }
}
