<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Homework;
use Faker\Factory as Faker;

class HomeworkCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $homeworks = Homework::all();
        foreach ($homeworks as $homework) {
            DB::table('homework_course')->insert([
                'homework_id' => $homework->id,
                'course_id' => $faker->randomElement(\App\Course::pluck('id')->toArray()),
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
            ]);
        }
    }
}
