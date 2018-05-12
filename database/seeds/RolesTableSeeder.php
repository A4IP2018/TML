<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['administrator', '', ''];
        DB::table('roles')->insert(
            [
                'name' => 'administrator',
                'rank' => 1
            ]
        );

        DB::table('roles')->insert(
            [
                'name' => 'member',
                'rank' => 10
            ]
        );

        DB::table('roles')->insert(
            [
                'name' => 'teacher',
                'rank' => 5
            ]
        );


    }
}
