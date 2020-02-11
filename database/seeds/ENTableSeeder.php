<?php

use Illuminate\Database\Seeder;

class ENTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['text' => 'Menu of the day'],
          ['text' => 'Children\'s menu'],
          ['text' => 'Family Combined'],
          ['text' => '1/2 grilled chicken + 2 regular drinks'],
          ['text' => 'Frankfurt Grande Menu'],
          ['text' => 'Pack Frankfurt for 2 persons'],
          ['text' => 'Iberian Burger Menu'],
          ['text' => 'Burger Baden Baden menu'],
          ['text' => 'Burger The Kaiser Menu'],
          ['text' => 'Sweet Goat Menu'],

          ['text' => 'Starters'],
          ['text' => 'First courses'],
          ['text' => 'Second dishes'],
          ['text' => 'Desserts'],
          ['text' => 'Beverages'],
          ['text' => 'Broths, soups and creams'],
          ['text' => 'Pasta, eggs and rice'],
          ['text' => 'Vegetables and salads'],
          ['text' => 'Fish and seafood'],
          ['text' => 'Meats'],

          ['text' => 'Potato chips'],
          ['text' => 'Pizza margarita'],
          ['text' => 'Hamburger'],
          ['text' => 'Grilled chicken'],
          ['text' => 'Paella'],
          ['text' => 'Frankfurt'],
          ['text' => 'Water'],
          ['text' => 'Beer'],
          ['text' => 'Coffee'],
          ['text' => 'Ice cream'],
        ])->mapWithKeys(function ($key) {
          static $key_id = 1;
          return factory(App\EN::class)->create([
              'key_id' => $key_id++,
              'text' => $key['text']
          ]);
        });
    }
}
