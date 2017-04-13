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
        for ($i = 1; $i <= 50; $i++) {
            DB::table('clients')->insert([
                'instructor_id' => $faker->numberBetween(1, 20),
                'name' => $faker->firstName,
                'first_surname' => $faker->lastName,
                'second_surname' => $faker->lastName,
                'gender' => $faker->randomElement(['m', 'f']),
                'age' => $faker->numberBetween(14, 80),
                'height' => $faker->numberBetween(140, 220),
                'weight' => $faker->numberBetween(30, 200),
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'rfc' => $this->makeRfc(),
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'profile_picture' => null,
                'remember_token' => null,
                'created_at' => date('Y,m,d H:i:s'),
                'updated_at' => date('Y,m,d H:i:s'),
                'deleted_at' => null
            ]);
        }
    }

    public function makeRfc()
    {
        $faker = \Faker\Factory::create();
        $rfc = '';
        for ($i=1; $i<=10; $i++) {
            $rfc .= $faker->randomLetter;
            $rfc .= $faker->randomDigit;
        }
        return $rfc;
    }
}
