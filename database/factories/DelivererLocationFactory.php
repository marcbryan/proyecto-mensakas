<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deliverer_Location;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Deliverer_Location::class, function (Faker $faker) {
	$faker = FakerFactory::create('es_ES');
    return [
        'deliverer_id' => $faker->numberBetween($min = 1, $max = 25),
        'lat' => $faker->latitude($min = -90, $max = 90),
        'lon' => $faker->longitude($min = -180, $max = 180),
        'precision' => "1",
        'provider' => "Google",
    ];
});
