<?php

use Illuminate\Database\Seeder;

class ESTableSeeder extends Seeder
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

          ['text' => 'Entrantes'],
          ['text' => 'Primeros platos'],
          ['text' => 'Segundos platos'],
          ['text' => 'Postres'],
          ['text' => 'Bebidas'],
          ['text' => 'Caldos, sopas y cremas'],
          ['text' => 'Pastas, huevos y arroces'],
          ['text' => 'Verduras y ensaladas'],
          ['text' => 'Pescados y mariscos'],
          ['text' => 'Carnes'],

          ['text' => 'Patatas fritas'],
          ['text' => 'Pizza margarita'],
          ['text' => 'Hamburguesa'],
          ['text' => 'Pollo a la brasa'],
          ['text' => 'Paella'],
          ['text' => 'Frankfurt'],
          ['text' => 'Agua'],
          ['text' => 'Cerveza'],
          ['text' => 'Café'],
          ['text' => 'Helado'],
        ])->mapWithKeys(function ($key) {
          static $key_id = 1;
          return factory(App\ES::class)->create([
              'key_id' => $key_id++,
              'text' => $key['text']
          ]);
        });
    }
}
