<?php

use Illuminate\Database\Seeder;

class MenuNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['text' => 'Menú del día'],
          ['text' => 'Menú infantil'],
          ['text' => 'Combinado Familiar'],
          ['text' => '1/2 pollo a la brasa + 2 bebidas regulares'],
          ['text' => 'Menú Frankfurt Grande'],
          ['text' => 'Pack Frankfurt para 2 personas'],
          ['text' => 'Menú Burger Ibérica'],
          ['text' => 'Menú Burger Baden Baden'],
          ['text' => 'Menú Burger The Kaiser'],
          ['text' => 'Menú Sweet Cabra'],
        ])->mapWithKeys(function($key) {
          static $menu_id = 1;
          return factory(App\Menu_Name::class)->create([
            'text' => $key['text']
            'menu_id' => $menu_id++,
            'lang' => 'ES',
          ]);
        });
    }
}
