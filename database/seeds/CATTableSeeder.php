<?php

use Illuminate\Database\Seeder;

class CATTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $keys = collect([
           ['text' => 'Menú del dia'],
           ['text' => 'Menú infantil'],
           ['text' => 'Combinat Familiar'],
           ['text' => '1/2 pollastre a l\' + 2 begudes regulars'],
           ['text' => 'Menú Frankfurt Gran'],
           ['text' => 'Pack Frankfurt per a 2 persones'],
           ['text' => 'Menú Burger Ibèrica'],
           ['text' => 'Menú Burger Baden Baden'],
           ['text' => 'Menú Burger The Kaiser'],
           ['text' => 'Menú Sweet Cabra'],

           ['text' => 'Entrants'],
           ['text' => 'Primers plats'],
           ['text' => 'Segons plats'],
           ['text' => 'Postres'],
           ['text' => 'Begudes'],
           ['text' => 'Brous, sopes i cremes'],
           ['text' => 'Pastes, ous i arrossos'],
           ['text' => 'Verdures i amanides'],
           ['text' => 'Peix i marisc'],
           ['text' => 'Carns'],

           ['text' => 'Patates fregides'],
           ['text' => 'Pizza margarida'],
           ['text' => 'Hamburguesa'],
           ['text' => 'Pollastre a l\'ast'],
           ['text' => 'Paella'],
           ['text' => 'Frankfurt'],
           ['text' => 'Aigua'],
           ['text' => 'Cervesa'],
           ['text' => 'Cafè'],
           ['text' => 'Gelat'],
         ])->mapWithKeys(function ($key) {
           static $key_id = 1;
           return factory(App\CAT::class)->create([
               'key_id' => $key_id++,
               'text' => $key['text']
           ]);
         });
     }
}
