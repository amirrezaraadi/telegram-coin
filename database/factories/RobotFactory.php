<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Robot>
 */
class RobotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'hour' => $this->faker->numberBetween(111,999),
            'amount' => $this->faker->numberBetween(111,999),
            'token' => $this->faker->numberBetween(111,999),

        ];
    }
}
