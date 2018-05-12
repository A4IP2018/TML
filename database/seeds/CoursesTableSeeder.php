<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['Logica', 1, 1, 5],
            ['Matematica', 1, 1, 4],
            ['Introducere in programare', 1, 1, 4],
            ['Programare orientata pe obiect', 1, 2, 6],
            ['Fundamentele algebrice ale informaticii', 1, 2, 5],
            ['Probabilitati si statistica', 1, 2, 4],
            ['Sisteme de operare', 1, 2, 5],
            ['Retele de calculatoare', 2, 1, 6],
            ['Baze de date', 2, 1, 5],
            ['Limbaje formale, automate si compilatoare', 2, 1, 4],
            ['Algoritmica grafurilor', 2, 1, 5],
            ['Tehnologii WEB', 2, 2, 5],
            ['Programare avansata', 2, 2, 6],
            ['Invatare automata', 3, 1, 5],
            ['Securitatea informatiei', 3, 1, 6],
            ['Inteligenta artificiala', 3, 2, 5],
            ['Practica - Programare in Python', 3, 2, 5],
            ['Retele Petri', 3, 2, 6]
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert([
                'course_title' => $course[0],
                'year' => $course[1],
                'semester' => $course[2],
                'credits' => $course[3],
                'slug' => str_slug(strval($course[1]).'_'.strval($course[2]).'_'.$course[0])
            ]);
        }
    }
}
