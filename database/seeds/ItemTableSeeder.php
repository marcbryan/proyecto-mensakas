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
        $keys = collect([
          ['type' => 'ENT'],
          ['type' => 'SEG'],
          ['type' => 'SEG'],
          ['type' => 'SEG'],
          ['type' => 'SEG'],
          ['type' => 'OTH'],
          ['type' => 'DRI'],
          ['type' => 'DRI'],
          ['type' => 'DRI'],
          ['type' => 'POS'],
        ])->mapWithKeys(function($key) {
          return factory(App\Item::class)->create([
            'type' => $key['type'],
          ]);
        });
    }
}
