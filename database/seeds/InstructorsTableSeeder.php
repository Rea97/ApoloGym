<?php

use Illuminate\Database\Seeder;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('instructors')->insert([
                'name' => $faker->name,
                'first_surname' => $faker->lastName,
                'second_surname' => $faker->lastName,
                'gender' => $faker->randomElement(['m', 'f']),
                'birth_date' => $faker->date(),
                'profile_picture' => null,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'salary' => $faker->randomFloat(2, 1500, 3000),
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'about_me' => $faker->text(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
