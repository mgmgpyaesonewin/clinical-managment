<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Problem;
use App\Consultation;
use App\Patient;
use Faker\Generator as Faker;

$factory->define(Problem::class, function (Faker $faker) {
    return [
        'type' => $faker->word,  
        'code' => $faker->bothify('###???'),
        'name' => $faker->name,
        'status' => 'Active Problem',
        'action' => $faker->randomElement(['Evolve', 'Combine']),
        'duration' => $faker->randomElement(['14 days', '28 days']),
        'consultation_id' => function () {
            return factory(Consultation::class)->create()->id;
        },
        'patient_id' => function () {
            return factory(Patient::class)->create()->id;
        },
    ];
});
