<?php

use Illuminate\Database\Seeder;

class DelivererLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         factory(App\Deliverer_Location::class, 10)->create();


    }
}
