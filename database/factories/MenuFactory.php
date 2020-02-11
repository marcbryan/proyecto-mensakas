<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'business_id' => $faker->numberBetween($min = 1, $max = 25),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 9),
        'sort' => 1
    ];
});
