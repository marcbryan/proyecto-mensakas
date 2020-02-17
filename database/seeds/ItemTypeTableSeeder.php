<?php

use Illuminate\Database\Seeder;

class ItemTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['type' => 'ENT'],
          ['type' => 'PRI'],
          ['type' => 'SEG'],
          ['type' => 'POS'],
          ['type' => 'DRI'],
          ['type' => 'OTH'],
        ])->mapWithKeys(function($key) {
          return factory(App\Item_Type::class)->create([
            'type' => $key['type'],
          ]);
        });
    }
}
