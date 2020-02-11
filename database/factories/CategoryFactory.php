<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Category::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    return [
      'internal_name' => $faker->realText($maxNbChars = 20),
      'background' => $faker->hexcolor,
      'icon' => $faker->imageUrl($width=64, $height=64, 'food'),
      'color' => $faker->hexcolor
    ];
});
