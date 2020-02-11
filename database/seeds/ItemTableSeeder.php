<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=21; $i <= 30; $i++) {
          factory(App\Item::class)->create([
            'key_id' => $i,
            'description_key' => $i+10
          ]);
        }
    }
}
