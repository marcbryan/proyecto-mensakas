<?php

use Illuminate\Database\Seeder;

class SuperuserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Superuser::class, 25)->create();
    }
}
