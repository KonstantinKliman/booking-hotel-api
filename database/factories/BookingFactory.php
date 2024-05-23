<?php

namespace Database\Factories;

use App\Enums\BookingStatusType;
use App\Enums\PaymentStatusType;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->first()->id,
            'guests_count' => fake()->numberBetween(1,5),
            'check_in_date' => fake()->dateTimeBetween('now', '+1 week'),
            'check_out_date' => fake()->dateTimeBetween('+1 week', '+2 weeks'),
            'total_price' => fake()->numberBetween(100, 10000),
            'additional_comments' => fake()->sentence(),
            'booking_status_id' => fake()->randomElement([
                BookingStatusType::Pending->value,
                BookingStatusType::Confirmed->value,
                BookingStatusType::Cancelled->value,
                BookingStatusType::Completed->value
            ]),
            'payment_status_id' => fake()->randomElement([
                PaymentStatusType::Pending->value,
                PaymentStatusType::Paid->value,
                PaymentStatusType::Failed->value
            ])
        ];
    }
}
