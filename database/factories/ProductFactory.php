<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'quantity' => $faker->randomNumber(2),
        'price' => $faker->randomNumber(4),
        'description' => $faker->sentence(),
        'min_order' => $faker->randomNumber(2),
        'max_order' => $faker->randomNumber(2),
    ];
});
