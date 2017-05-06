<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
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
            $service = \App\Models\Service::find($faker->numberBetween(1000, 1009));
            $invoice = new \App\Models\Invoice([
                'client_id' => $faker->numberBetween(10000, 10020),
                'total' => $service->price,
                'due_date' => $faker->date(),
                'status' => 'sin pagar'
            ]);
            $invoice->save();
            $invoice->services()->attach($service->id);
        }
    }
}
