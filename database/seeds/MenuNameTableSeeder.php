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
          ['name' => 'Menú del día'],
          ['name' => 'Menú infantil'],
          ['name' => 'Combinado Familiar'],
          ['name' => '1/2 pollo a la brasa + 2 bebidas regulares'],
          ['name' => 'Menú Frankfurt Grande'],
          ['name' => 'Pack Frankfurt para 2 personas'],
          ['name' => 'Menú Burger Ibérica'],
          ['name' => 'Menú Burger Baden Baden'],
          ['name' => 'Menú Burger The Kaiser'],
          ['name' => 'Menú Sweet Cabra'],
        ])->mapWithKeys(function($key) {
          static $menu_id = 1;
          return factory(App\Menu_Name::class)->create([
            'name' => $key['name'],
            'menu_id' => $menu_id++,
            'lang' => 'ES',
          ]);
        });

        $keys = collect([
          ['name' => 'Menú del dia'],
          ['name' => 'Menú infantil'],
          ['name' => 'Combinat Familiar'],
          ['name' => '1/2 pollastre a l\'ast + 2 begudes regulars'],
          ['name' => 'Menú Frankfurt Gran'],
          ['name' => 'Pack Frankfurt per a 2 persones'],
          ['name' => 'Menú Burger Ibèrica'],
          ['name' => 'Menú Burger Baden Baden'],
          ['name' => 'Menú Burger The Kaiser'],
          ['name' => 'Menú Sweet Cabra'],
        ])->mapWithKeys(function($key) {
          static $menu_id = 1;
          return factory(App\Menu_Name::class)->create([
            'name' => $key['name'],
            'menu_id' => $menu_id++,
            'lang' => 'CAT',
          ]);
        });

        $keys = collect([
          ['name' => 'Menu of the day'],
          ['name' => 'Children\'s menu'],
          ['name' => 'Family Combined'],
          ['name' => '1/2 grilled chicken + 2 regular drinks'],
          ['name' => 'Frankfurt Grande Menu'],
          ['name' => 'Pack Frankfurt for 2 persons'],
          ['name' => 'Iberian Burger Menu'],
          ['name' => 'Burger Baden Baden menu'],
          ['name' => 'Burger The Kaiser Menu'],
          ['name' => 'Sweet Goat Menu'],
        ])->mapWithKeys(function($key) {
          static $menu_id = 1;
          return factory(App\Menu_Name::class)->create([
            'name' => $key['name'],
            'menu_id' => $menu_id++,
            'lang' => 'EN',
          ]);
        });
    }
}
