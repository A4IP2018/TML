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

        //factory(App\User_Example::class,50)->create();

        factory(App\Category::class, 50)->create();

        //factory(App\Teacher_Information::class, 50)->create();

        factory(App\Report_type::class, 50)->create();

        factory(App\Report::class, 50)->create();

        factory(App\Group::class, 50)->create();

        factory(App\Student_information::class,50)->create();

        factory(App\Homework::class,50)->create();

        factory(App\Grade::class,50)->create();

        factory(App\Comparison::class,50)->create();

        //factory(App\Teacher_Information_Group::class,50)->create();

        //factory(App\User_Information::class,50)->create();

        //factory(App\Password_reset::class,50)->create();

        //factory(App\Message::class, 50)->create();


    }
}