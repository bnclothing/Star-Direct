<?php

namespace Database\Factories;

use App\Models\Magazine;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'charge_name' => $this->faker->unique()->text(10),
            'charge_amount' => $this->faker->numberBetween(1, 100),
            'id_magazine' => Magazine::all()->random()->id_magazine,
        ];
    }
}
