<?php

use Illuminate\Database\Seeder;

class ItemNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['name' => 'Patatas fritas'],
          ['name' => 'Pizza margarita'],
          ['name' => 'Hamburguesa'],
          ['name' => 'Pollo a la brasa'],
          ['name' => 'Paella'],
          ['name' => 'Frankfurt'],
          ['name' => 'Agua'],
          ['name' => 'Cerveza'],
          ['name' => 'Café'],
          ['name' => 'Helado'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\Item_Name::class)->create([
            'name' => $key['name'],
            'item_id' => $item_id++,
            'lang' => 'ES',
          ]);
        });

        $keys = collect([
          ['name' => 'Patates fregides'],
          ['name' => 'Pizza margarida'],
          ['name' => 'Hamburguesa'],
          ['name' => 'Pollastre a l\'ast'],
          ['name' => 'Paella'],
          ['name' => 'Frankfurt'],
          ['name' => 'Aigua'],
          ['name' => 'Cervesa'],
          ['name' => 'Cafè'],
          ['name' => 'Gelat'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\Item_Name::class)->create([
            'name' => $key['name'],
            'item_id' => $item_id++,
            'lang' => 'CAT',
          ]);
        });

        $keys = collect([
          ['name' => 'Potato chips'],
          ['name' => 'Pizza margarita'],
          ['name' => 'Hamburger'],
          ['name' => 'Grilled chicken'],
          ['name' => 'Paella'],
          ['name' => 'Frankfurt'],
          ['name' => 'Water'],
          ['name' => 'Beer'],
          ['name' => 'Coffee'],
          ['name' => 'Ice cream'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\Item_Name::class)->create([
            'name' => $key['name'],
            'item_id' => $item_id++,
            'lang' => 'EN',
          ]);
        });

    }
}
