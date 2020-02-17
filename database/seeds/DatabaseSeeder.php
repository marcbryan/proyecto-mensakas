<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          LanguageTableSeeder::class,
          BusinessTableSeeder::class,
          SuperuserTableSeeder::class,
          ConsumerTableSeeder::class,
          MenuTableSeeder::class,
          CategoryTableSeeder::class,
          CategoryNameTableSeeder::class,
          ItemTypeTableSeeder::class,
          ItemTypeNameTableSeeder::class,
          ItemTableSeeder::class,
          MenuNameTableSeeder::class,
          ItemNameTableSeeder::class,
        ]);
    }
}
