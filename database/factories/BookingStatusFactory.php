<?php

namespace Database\Factories;

use App\Enums\BookingStatusType;
use App\Models\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingStatus>
 */
class BookingStatusFactory extends Factory
{
    protected $model = BookingStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                BookingStatusType::Pending->name,
                BookingStatusType::Confirmed->name,
                BookingStatusType::Cancelled->name,
                BookingStatusType::Completed->name
            ]),
        ];
    }
}
