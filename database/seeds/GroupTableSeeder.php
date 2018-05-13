<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $groups = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6'];

        foreach ($groups as $group) {
            DB::table('groups')->insert(
                [
                    'name' => $group,
                ]
            );
        }

    }
}
