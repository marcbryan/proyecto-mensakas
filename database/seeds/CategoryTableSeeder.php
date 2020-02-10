<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=11; $i <= 20; $i++) {
          factory(App\Category::class)->create([
            'key_id' => $i
          ]);
        }
    }
}
