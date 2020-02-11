<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 9),
        'type' => $faker->lexify('???'),
        'image_url' => $faker->imageUrl($width=64, $height=64, 'food'),
    ];
});
