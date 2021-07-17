<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'dob' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d/m/Y'),
        'nrc' => '12/SaKhaNa(N)082719',
        'phone' => $faker->phoneNumber,
        'organization' => 'Group of Hospital',
        'gender' => 'male',
        'email' => $faker->email,
        'password' => bcrypt('abcd1234'),
        'hospital_id' => 1
    ];
});
