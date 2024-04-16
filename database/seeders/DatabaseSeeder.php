<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Magazine::factory(10)->create();
        \App\Models\Currency::factory(10)->create();
        \App\Models\check::factory(10)->create();
        \App\Models\charge::factory(10)->create();
        \App\Models\Responsable::factory(10)->create();
        \App\Models\Client_Magazine::factory(10)->create();
        \App\Models\supplier::factory(10)->create();
        \App\Models\Cofre::factory(10)->create();
        \App\Models\seller_magazine::factory(10)->create();
        \App\Models\supplier_magazine::factory(10)->create();
    }
}
