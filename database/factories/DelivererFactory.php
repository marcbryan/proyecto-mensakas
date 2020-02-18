<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deliverer;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Deliverer::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    $start_num = $faker->randomElement($array = array (9, 6));
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => Hash::make($faker->bothify('????####')),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
