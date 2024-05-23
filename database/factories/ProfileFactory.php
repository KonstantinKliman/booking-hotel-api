<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'dob' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'company_name' => null,
            'country' => fake()->country(),
            'city' => fake()->city(),
        ];
    }

    public function owner()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_name' => fake()->company()
            ];
        });
    }
}
