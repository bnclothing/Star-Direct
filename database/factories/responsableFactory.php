<?php

namespace Database\Factories;

use App\Models\Magazine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class responsableFactory extends Factory
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
            'id_magazine' => Magazine::all()->random()->id_magazine,
        ];
    }
}
