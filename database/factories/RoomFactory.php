<?php

namespace Database\Factories;

use App\Enums\RoomType as RoomTypeEnum;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'type_id' => fake()->randomElement(RoomTypeEnum::cases()),
            'description' => fake()->paragraph(1),
            'price_per_night' => fake()->numberBetween(100, 100000),
            'is_available' => fake()->boolean()
        ];
    }
}
