<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consultation;
use App\Patient;
use App\User;
use Faker\Generator as Faker;

$factory->define(Consultation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'patient_id' => function () {
            return factory(Patient::class)->create()->id;
        },
        'doctor_id' => function () {
            return factory(User::class)->create()->id;
        },
        'appointment_id' => 1
    ];
});
