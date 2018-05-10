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

$factory->define(App\TeacherInformationGroup::class, function (Faker $faker) {
    return [
        'group_id' => $faker->randomElement(\App\Group::pluck('id')->toArray()),
        'teacher_information_id' => $faker->randomElement(\App\TeacherInformation::pluck('id')->toArray())
    ];
});