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

$factory->define(App\User_Information::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'phone_number' => $faker->phoneNumber,
        'street_name' => $faker->streetName,
        'street_number' => $faker->streetAddress,
        'email' => $faker->email
    ];
});