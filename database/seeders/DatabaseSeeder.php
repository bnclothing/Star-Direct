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
        //Users
        \App\Models\User::create([
            'user_id'=>'1',
            'name' => 'name 1',
            'email' => 'email 1',
            'phone' => 'phone 1',
            'password' => 'password 1',
            'type'=> '1',
        ]);
        \App\Models\User::create([
            'user_id' => '5',
            'name' => 'name 5',
            'email' => 'email 5',
            'phone' => 'phone 5',
            'password' => 'password 5',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '6',
            'name' => 'name 6',
            'email' => 'email 6',
            'phone' => 'phone 6',
            'password' => 'password 6',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '7',
            'name' => 'name 7',
            'email' => 'email 7',
            'phone' => 'phone 7',
            'password' => 'password 7',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '8',
            'name' => 'name 8',
            'email' => 'email 8',
            'phone' => 'phone 8',
            'password' => 'password 8',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '9',
            'name' => 'name 9',
            'email' => 'email 9',
            'phone' => 'phone 9',
            'password' => 'password 9',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '10',
            'name' => 'name 10',
            'email' => 'email 10',
            'phone' => 'phone 10',
            'password' => 'password 10',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '11',
            'name' => 'name 11',
            'email' => 'email 11',
            'phone' => 'phone 11',
            'password' => 'password 11',
            'type' => '1',
        ]);
        \App\Models\User::create([
            'user_id' => '2',
            'name' => 'name 2',
            'email' => 'email 2',
            'phone' => 'phone 2',
            'password' => 'password 2',
            'type' => '2',
        ]);
        \App\Models\User::create([
            'user_id' => '3',
            'name' => 'name 3',
            'email' => 'email 3',
            'phone' => 'phone 3',
            'password' => 'password 3',
            'type' => '3',
        ]);
        \App\Models\User::create([
            'user_id' => '4',
            'name' => 'name 4',
            'email' => 'email 4',
            'phone' => 'phone 4',
            'password' => 'password 4',
            'type' => '4',
        ]);

        //Magazines
        \App\Models\Magazine::create([
            'id_magazine' => '1',
            'code_magazine' => 'MGZN 1',
            'magazine_name' => 'MGZN 1',
            'magazine_adresse'  => 'MGZN 1',
            'magazine_type' => '1',
            'id_primary_magazine' => null,
            'responsable_id' => '1',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '2',
            'code_magazine' => 'MGZN 2',
            'magazine_name' => 'MGZN 2',
            'magazine_adresse'  => 'MGZN 2',
            'magazine_type' => '1',
            'id_primary_magazine' => null,
            'responsable_id' => '5',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '3',
            'code_magazine' => 'MGZN 3',
            'magazine_name' => 'MGZN 3',
            'magazine_adresse'  => 'MGZN 3',
            'magazine_type' => '1',
            'id_primary_magazine' => null,
            'responsable_id' => '6',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '4',
            'code_magazine' => 'MGZN 4',
            'magazine_name' => 'MGZN 4',
            'magazine_adresse'  => 'MGZN 4',
            'magazine_type' => '1',
            'id_primary_magazine' => null,
            'responsable_id' => '7',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '5',
            'code_magazine' => 'MGZN 5',
            'magazine_name' => 'MGZN 5',
            'magazine_adresse'  => 'MGZN 5',
            'magazine_type' => '2',
            'id_primary_magazine' => '1',
            'responsable_id' => '8',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '6',
            'code_magazine' => 'MGZN 6',
            'magazine_name' => 'MGZN 6',
            'magazine_adresse'  => 'MGZN 6',
            'magazine_type' => '2',
            'id_primary_magazine' => '2',
            'responsable_id' => '9',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '7',
            'code_magazine' => 'MGZN 7',
            'magazine_name' => 'MGZN 7',
            'magazine_adresse'  => 'MGZN 7',
            'magazine_type' => '2',
            'id_primary_magazine' => '3',
            'responsable_id' => '10',
        ]);
        \App\Models\Magazine::create([
            'id_magazine' => '8',
            'code_magazine' => 'MGZN 8',
            'magazine_name' => 'MGZN 8',
            'magazine_adresse'  => 'MGZN 8',
            'magazine_type' => '2',
            'id_primary_magazine' => '4',
            'responsable_id' => '11',
        ]);

        //Currencies
        \App\Models\Currency::create(['id_currency' => 'MAD', 'currency_name' => 'Moroccan Dirham', 'devise' => 1]);
        \App\Models\Currency::create(['id_currency' => 'USD', 'currency_name' => 'Dollar', 'devise' => 9]);
        \App\Models\Currency::create(['id_currency' => 'EUR', 'currency_name' => 'Euro', 'devise' => 10]);

        //Responsable
        \App\Models\Responsable::create([
            'user_id' => '1',
            'id_magazine' => '1',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '5',
            'id_magazine' => '2',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '6',
            'id_magazine' => '3',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '7',
            'id_magazine' => '4',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '8',
            'id_magazine' => '5',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '9',
            'id_magazine' => '6',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '10',
            'id_magazine' => '7',
        ]);
        \App\Models\Responsable::create([
            'user_id' => '11',
            'id_magazine' => '8',
        ]);


        //Client Magazines
        \App\Models\Client_Magazine::create([
            'user_id'=> '3',
            'id_magazine' => '1',
        ]);
        \App\Models\Client_Magazine::create([
            'user_id' => '3',
            'id_magazine' => '2',
        ]);
        \App\Models\Client_Magazine::create([
            'user_id' => '3',
            'id_magazine' => '3',
        ]);

        //supplier
        \App\Models\supplier::create([
            'user_id' => '4',
            'id_currency' =>'MAD',
            'is_national' => true,
        ]);

        //seller Magazines
        \App\Models\seller_magazine::create([
            'user_id'=> '2',
            'id_magazine' => '3'
        ]);
        \App\Models\seller_magazine::create([
            'user_id' => '2',
            'id_magazine' => '4'
        ]);
        \App\Models\seller_magazine::create([
            'user_id' => '2',
            'id_magazine' => '5'
        ]);

        //supplier magazines
        \App\Models\supplier_magazine::create([
            'user_id' => '4',
            'id_magazine' => '5'
        ]);
        \App\Models\supplier_magazine::create([
            'user_id' => '4',
            'id_magazine' => '6'
        ]);
        \App\Models\supplier_magazine::create([
            'user_id' => '4',
            'id_magazine' => '7'
        ]);

        // \App\Models\User::factory(10)->create();
        // \App\Models\Magazine::factory(10)->create();
        // \App\Models\Currency::factory(10)->create();
        // \App\Models\check::factory(10)->create();
        // \App\Models\charge::factory(10)->create();
        // \App\Models\Responsable::factory(10)->create();
        // \App\Models\Client_Magazine::factory(10)->create();
        // \App\Models\supplier::factory(10)->create();
        // \App\Models\Cofre::factory(10)->create();
        // \App\Models\seller_magazine::factory(10)->create();
        // \App\Models\supplier_magazine::factory(10)->create();
    }
    
}
