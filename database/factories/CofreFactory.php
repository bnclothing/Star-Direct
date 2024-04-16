<?php

namespace Database\Factories;

use App\Models\check;
use App\Models\Magazine;
use Illuminate\Database\Eloquent\Factories\Factory;

class CofreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'montant_espece' => $this->faker->randomNumber(4),
            'id_magazine' => Magazine::all()->random()->id_magazine,
            'id_check' => check::all()->random()->id_check,
        ];
    }
}
