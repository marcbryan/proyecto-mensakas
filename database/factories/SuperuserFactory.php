<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Superuser;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Superuser::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => hash('sha256', $faker->numerify('####')),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
