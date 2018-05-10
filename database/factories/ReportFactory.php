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

$factory->define(App\Report::class, function (Faker $faker) {
    return [
        'description' => $faker->text(500),
        'report_type_id' => $faker->randomElement(\App\ReportType::pluck('id')->toArray())
    ];
});
