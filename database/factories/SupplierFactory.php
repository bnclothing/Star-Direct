<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Magazine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->user_id,
            'id_currency' => Currency::all()->random()->id_currency,
            'is_national'=>$this->faker->boolean(70)
        ];
    }
}
