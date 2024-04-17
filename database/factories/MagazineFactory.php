<?php

namespace Database\Factories;

use App\Models\Magazine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SebastianBergmann\Type\NullType;

class MagazineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement([1, 2]);

        return [
            'code_magazine' => $this->faker->unique()->text(10),
            'magazine_name' => $this->faker->unique()->company(),
            'magazine_type' => $type,
            'magazine_adresse' => $this->faker->address(),
            'is_active' => $this->faker->boolean(90),
            'responsable_id' => User::all()->random()->user_id,
            'id_primary_magazine' => $type == 1 ? null : 1,
        ];
    }
}
