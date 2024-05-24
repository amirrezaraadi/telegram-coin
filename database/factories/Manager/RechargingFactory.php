<?php

namespace Database\Factories\Manager;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager\Recharging>
 */
class RechargingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'size' => $this->faker->numberBetween(111, 999),
            'unit' => $this->faker->numberBetween(1, 9),
            'amount' => $this->faker->numberBetween(11111, 99999),
        ];
    }
}
