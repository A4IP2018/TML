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

$factory->define(App\Grade::class, function (Faker $faker) {
    return [
        'grade' => $faker->numberBetween(1,10),
        'user_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'homework_id' => $faker->randomElement(\App\Homework::pluck('id')->toArray())
    ];
});
