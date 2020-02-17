<?php

use Illuminate\Database\Seeder;

class ItemTypeNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['name' => 'Entrantes', 'type' => 'ENT'],
          ['name' => 'Primeros platos', 'type' => 'PRI'],
          ['name' => 'Segundos platos', 'type' => 'SEG'],
          ['name' => 'Postres', 'type' => 'POS'],
          ['name' => 'Bebidas', 'type' => 'DRI'],
          ['name' => 'Otros', 'type' => 'OTH'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\ItemType_Name::class)->create([
            'name' => $key['name'],
            'type' => $key['type'],
            'lang' => 'ES',
          ]);
        });

        $keys = collect([
          ['name' => 'Entrants', 'type' => 'ENT'],
          ['name' => 'Primers plats', 'type' => 'PRI'],
          ['name' => 'Segons plats', 'type' => 'SEG'],
          ['name' => 'Postres', 'type' => 'POS'],
          ['name' => 'Begudes', 'type' => 'DRI'],
          ['name' => 'Altres', 'type' => 'OTH'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\ItemType_Name::class)->create([
            'name' => $key['name'],
            'type' => $key['type'],
            'lang' => 'CAT',
          ]);
        });

        $keys = collect([
          ['name' => 'Starters', 'type' => 'ENT'],
          ['name' => 'First dishes', 'type' => 'PRI'],
          ['name' => 'Second dishes', 'type' => 'SEG'],
          ['name' => 'Desserts', 'type' => 'POS'],
          ['name' => 'Drinks', 'type' => 'DRI'],
          ['name' => 'Others', 'type' => 'OTH'],
        ])->mapWithKeys(function($key) {
          static $item_id = 1;
          return factory(App\ItemType_Name::class)->create([
            'name' => $key['name'],
            'type' => $key['type'],
            'lang' => 'EN',
          ]);
        });
    }
}
