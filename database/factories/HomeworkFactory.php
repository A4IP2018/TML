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

$factory->define(App\Homework::class, function (Faker $faker) {

    $name = $faker->paragraph(1);

    return [
        'description' => $faker->text,
        'user_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'category_id' => $faker->randomElement(\App\Category::pluck('id')->toArray()),
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
