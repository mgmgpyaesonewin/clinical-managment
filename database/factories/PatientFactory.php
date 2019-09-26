<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dob' => $faker->date,
        'gender' => 'Male',
        'user_id' => 1, // Authorizer For Patient
        'hospital_id' => 1,
        'address' => $faker->address,
        'city' => $faker->city,
        'phone_number' => $faker->phoneNumber
    ];
});
