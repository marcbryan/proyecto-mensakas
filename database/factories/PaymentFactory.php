<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Payment::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    return [
        'order_id' => $faker->numberBetween($min = 1, $max = 25),
        'amount' => $faker->numberBetween($min = 25, $max = 50),
        'token' => Hash::make($faker->bothify('????####')),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
