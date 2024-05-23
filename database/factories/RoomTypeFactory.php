<?php

namespace Database\Factories;

use App\Enums\RoomType as RoomTypeEnum;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                RoomTypeEnum::Single->name,
                RoomTypeEnum::Double->name,
                RoomTypeEnum::Twin->name,
                RoomTypeEnum::Suite->name,
                RoomTypeEnum::Standard->name,
                RoomTypeEnum::Family->name
            ]),
        ];
    }
}
