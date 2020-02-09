<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
$factory->define(Business::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    $now = date('Y-m-d H:i:s');
    $start_num = $faker->randomElement($array = array (9, 6));
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'lat' => $faker->latitude($min = -90, $max = 90),
        'lon' => $faker->longitude($min = -180, $max = 180),
        'phone' => $faker->numerify($start_num.'########'),
        'email' => $faker->email,
        'zipcode' => $faker->numerify('#####'),
        'created_at' => $now,
        'updated_at' => $now
    ];
});
