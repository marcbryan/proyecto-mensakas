<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consumer;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Consumer::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    $start_num = $faker->randomElement($array = array (9, 6));
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'address' => $faker->address,
        'zipcode' => $faker->numerify('#####'),
        'phone' => $faker->numerify($start_num.'########'),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
