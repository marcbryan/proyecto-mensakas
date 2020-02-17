<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Category::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    return [
      'icon' => $faker->imageUrl($width=64, $height=64, 'food'),
      'color' => $faker->hexcolor
    ];
});
