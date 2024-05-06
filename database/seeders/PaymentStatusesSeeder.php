<?php

namespace Database\Seeders;

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
        PaymentStatus::create(['name' => 'pending']);
        PaymentStatus::create(['name' => 'paid']);
        PaymentStatus::create(['name' => 'failed']);
    }
}
