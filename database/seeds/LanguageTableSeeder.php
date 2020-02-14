<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = collect([
          ['name' => 'ES'],
          ['name' => 'CAT'],
          ['name' => 'EN'],
        ])->mapWithKeys(function($key) {
          return factory(App\Language::class)->create([
              'name' => $key['name']
          ]);
        });
    }
}
