<?php

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

$factory->define(App\Comparison::class, function (Faker $faker) {
    return [
        'homework_id_1' => $faker->randomElement(\App\Homework::pluck('id')->toArray()),
        'homework_id_2' => $faker->randomElement(\App\Homework::pluck('id')->toArray()),
        'plagiarism_degree' => $faker->numberBetween(1,100),
        'user_id' => $faker->randomElement(\App\User::pluck('id')->toArray())
    ];
});