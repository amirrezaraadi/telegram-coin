<?php

namespace Database\Factories\Manager;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager\Trophy>
 */
class MultipleTouchesFactory extends Factory
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
            'unit' => $this->faker->numberBetween(111 , 999),
            'amount' => $this->faker->numberBetween(111 , 999),
        ];
    }
}
