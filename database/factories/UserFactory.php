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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nr_matricol' => str_random(18),
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'role_id' => $faker->randomElement(\App\Role::pluck('id')->toArray()),
    ];
});
