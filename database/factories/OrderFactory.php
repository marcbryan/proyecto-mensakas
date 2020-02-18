<?php


use App\Order;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

$factory->define(Order::class, function (Faker $faker) {
    $faker = FakerFactory::create('es_ES');
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 25),
        'business_id' => $faker->numberBetween($min = 1, $max = 25),
        'deliverer_id' => $faker->numberBetween($min = 1, $max = 25),
        'json' => json_encode(["order" => $faker->randomNumber()] ),
        'created_at' => now(),
        'updated_at' => now(),
        
    ];
});
