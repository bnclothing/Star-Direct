<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'num_check' => $this->faker->randomNumber(9),
            'montant_check' => $this->faker->randomNumber(4),
            'user_name' => $this->faker->name(),
        ];
    }
}
