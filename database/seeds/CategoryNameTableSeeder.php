<?php

use Illuminate\Database\Seeder;

class CategoryNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['name' => 'Americana'],
          ['name' => 'Italiana'],
          ['name' => 'Japonesa'],
          ['name' => 'Turca'],
          ['name' => 'Mexicana'],
          ['name' => 'Mediterránea'],
          ['name' => 'Hindú'],
          ['name' => 'Tailandesa'],
          ['name' => 'Vegana'],
          ['name' => 'Saludable'],
          ['name' => 'Asiática'],
          ['name' => 'Árabe'],
          ['name' => 'Latina'],
          ['name' => 'Burger'],
          ['name' => 'Pollo'],
          ['name' => 'Sandwich'],
          ['name' => 'Desayuno & merienda'],
          ['name' => 'Zumos'],
        ])->mapWithKeys(function($key) {
          static $category_id = 1;
          return factory(App\Category_Name::class)->create([
            'name' => $key['name'],
            'category_id' => $category_id++,
            'lang' => 'ES'
          ]);
        });

        $keys = collect([
          ['name' => 'Americana'],
          ['name' => 'Italiana'],
          ['name' => 'Japonesa'],
          ['name' => 'Turca'],
          ['name' => 'Mexicana'],
          ['name' => 'Mediterrània'],
          ['name' => 'Hindú'],
          ['name' => 'Tailandesa'],
          ['name' => 'Vegana'],
          ['name' => 'Saludable'],
          ['name' => 'Asiàtica'],
          ['name' => 'Àrab'],
          ['name' => 'Llatina'],
          ['name' => 'Burger'],
          ['name' => 'Pollastre'],
          ['name' => 'Sandwich'],
          ['name' => 'Esmorzar & berenar'],
          ['name' => 'Sucs'],
        ])->mapWithKeys(function($key) {
          static $category_id = 1;
          return factory(App\Category_Name::class)->create([
            'name' => $key['name'],
            'category_id' => $category_id++,
            'lang' => 'CAT'
          ]);
        });

        $keys = collect([
          ['name' => 'American'],
          ['name' => 'Italian'],
          ['name' => 'Japanese'],
          ['name' => 'Turkish'],
          ['name' => 'Mexican'],
          ['name' => 'Mediterranean'],
          ['name' => 'Hindu'],
          ['name' => 'Thai'],
          ['name' => 'Vegan'],
          ['name' => 'Healthy'],
          ['name' => 'Asian'],
          ['name' => 'Arabic'],
          ['name' => 'Latina'],
          ['name' => 'Burger'],
          ['name' => 'Chicken'],
          ['name' => 'Sandwich'],
          ['name' => 'Breakfast & snack'],
          ['name' => 'Juices'],
        ])->mapWithKeys(function($key) {
          static $category_id = 1;
          return factory(App\Category_Name::class)->create([
            'name' => $key['name'],
            'category_id' => $category_id++,
            'lang' => 'EN'
          ]);
        });
    }
}
