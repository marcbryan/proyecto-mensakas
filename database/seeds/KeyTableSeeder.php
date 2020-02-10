<?php

use Illuminate\Database\Seeder;

class KeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['name' => 'MENU1_NAME'],
          ['name' => 'MENU2_NAME'],
          ['name' => 'MENU3_NAME'],
          ['name' => 'MENU4_NAME'],
          ['name' => 'MENU5_NAME'],
          ['name' => 'MENU6_NAME'],
          ['name' => 'MENU7_NAME'],
          ['name' => 'MENU8_NAME'],
          ['name' => 'MENU9_NAME'],
          ['name' => 'MENU10_NAME'],
          ['name' => 'CATEGORY1_NAME'],
          ['name' => 'CATEGORY2_NAME'],
          ['name' => 'CATEGORY3_NAME'],
          ['name' => 'CATEGORY4_NAME'],
          ['name' => 'CATEGORY5_NAME'],
          ['name' => 'CATEGORY6_NAME'],
          ['name' => 'CATEGORY7_NAME'],
          ['name' => 'CATEGORY8_NAME'],
          ['name' => 'CATEGORY9_NAME'],
          ['name' => 'CATEGORY10_NAME'],
          ['name' => 'ITEM1_NAME'],
          ['name' => 'ITEM2_NAME'],
          ['name' => 'ITEM3_NAME'],
          ['name' => 'ITEM4_NAME'],
          ['name' => 'ITEM5_NAME'],
          ['name' => 'ITEM6_NAME'],
          ['name' => 'ITEM7_NAME'],
          ['name' => 'ITEM8_NAME'],
          ['name' => 'ITEM9_NAME'],
          ['name' => 'ITEM10_NAME'],
        ])->mapWithKeys(function ($key) {
          return factory(App\Key::class)->create([
              'key_name' => $key['name']
          ]);
        });
    }
}
