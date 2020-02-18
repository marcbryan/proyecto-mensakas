<?php

use Illuminate\Database\Seeder;

class DelivererTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         factory(App\Deliverer::class, 25)->create();
    }
}
