<?php

namespace Database\Factories\Manager;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager\Energy>
 */
class EnergyFactory extends Factory
{

    public function definition(): array
    {

        return [

            'title' => $this->faker->biasedNumberBetween(1, 9),
            'size' => $this->faker->numberBetween(111, 999),
            'amount' => $this->faker->numberBetween(11111, 99999),
        ];
    }
}
