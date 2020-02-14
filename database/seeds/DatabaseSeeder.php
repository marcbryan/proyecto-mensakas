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
          BusinessTableSeeder::class,
          SuperuserTableSeeder::class,
          ConsumerTableSeeder::class,
          KeyTableSeeder::class,
          MenuTableSeeder::class,
          CategoryTableSeeder::class,
          ItemTableSeeder::class,
          ESTableSeeder::class,
          CATTableSeeder::class,
          ENTableSeeder::class,
          LanguageTableSeeder::class,
          MenuNameTableSeeder::class
        ]);
    }
}
