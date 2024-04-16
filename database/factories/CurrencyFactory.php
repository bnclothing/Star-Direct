<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_currency' => $this->faker->unique()->currencyCode,
            'currency_name' => $this->faker->currencyCode,
            'devise' => $this->faker->numberBetween(1, 3),
        ];
    }
}
