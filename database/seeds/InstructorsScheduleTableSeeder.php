<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InstructorsScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 20; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $from = $faker->time();
                $to = $faker->time();
                $diff = getHoursDiff($from, $to);
                \DB::table('instructors_schedule')->insert([
                    'instructor_id' => $i,
                    'day' => $j,
                    'from' => $from,
                    'to' => $to,
                    'hours' => $diff,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
