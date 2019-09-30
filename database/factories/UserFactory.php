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
        'name' => 'Pyae Sone',
        'address' => $faker->address,
        'dob' => '14/12/1995',
        'nrc' => '12/SaKhaNa(N)082719',
        'phone' => $faker->phoneNumber,
        'organization' => 'Group of Hospital',
        'gender' => 'male',
        'email' => 'pyae@gmail.com',
        'password' => bcrypt('abcd1234')
    ];
});
