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
            'title' => $this->faker->title() ,
            'hour' => $this->faker->numberBetween(1, 2),
            'amount' => $this->faker->numberBetween(11, 22),
            'token' => $this->faker->numberBetween(11, 22),
        ];
    }
}
