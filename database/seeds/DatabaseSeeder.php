<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Role::class, 50)->create();

        factory(App\User::class, 50)->create();

        factory(App\Category::class, 50)->create();

        $this->call(CoursesTableSeeder::class);

        factory(App\TeacherInformation::class, 50)->create();

        factory(App\ReportType::class, 50)->create();

        factory(App\Report::class, 50)->create();

        factory(App\Group::class, 50)->create();

        factory(App\StudentInformation::class,50)->create();

        factory(App\Homework::class,5)->create();

        factory(App\Grade::class,50)->create();

        factory(App\Comparison::class,50)->create();

        factory(App\TeacherInformationGroup::class,50)->create();

        factory(App\UserInformation::class,50)->create();

        factory(App\Message::class, 50)->create();

        $this->call(FormatsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
    }
}