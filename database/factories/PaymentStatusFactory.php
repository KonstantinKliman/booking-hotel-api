<?php

namespace Database\Factories;

use App\Enums\PaymentStatusType;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentStatus>
 */
class PaymentStatusFactory extends Factory
{
    protected $model = PaymentStatus::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                PaymentStatusType::Pending->name,
                PaymentStatusType::Paid->name,
                PaymentStatusType::Failed->name
            ]),
        ];
    }
}
