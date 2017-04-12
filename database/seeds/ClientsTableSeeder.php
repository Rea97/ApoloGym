<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('clients')->insert([
            'name' => $faker->name,
            'first_surname' => $faker->lastName,
            'second_surname' => $faker->lastName,
            'gender' => 'm',
            'age' => 50,
            'height' => $faker->numberBetween(140, 220),
            'weight' => $faker->numberBetween(30, 200),
            'phone_number' => $faker->phoneNumber,
            'address' => $faker->address,
            'rfc' => 'qwevgbu231evybv',
            'email' => 'client@test.com',
            'password' => bcrypt('password'),
            'profile_picture' => null,
            'remember_token' => null,
            'created_at' => date('Y,m,d H:i:s'),
            'updated_at' => date('Y,m,d H:i:s'),
            'deleted_at' => null
        ]);
    }
}
