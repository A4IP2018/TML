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

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id_sender' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'user_id_receiver' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'subject' => $faker->text(50),
        'content' => $faker->text(500)

    ];
});
