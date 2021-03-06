<?php

use Illuminate\Database\Seeder;

class FormatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formats')->insert(
            [
            'mime_type' => 'plain/text',
            'extension_name' => '.txt',
            ]
        );

        DB::table('formats')->insert(
            [
            'mime_type' => 'application/msword',
            'extension_name' => '.doc',
            ]
        );

        DB::table('formats')->insert(
            [
            'mime_type' => 'application/pdf',
            'extension_name' => '.pdf',
            ]
        );

        DB::table('formats')->insert(
            [
            'mime_type' => 'application/zip',
            'extension_name' => '.zip',
            ]
        );

        DB::table('formats')->insert(
            [
            'mime_type' => 'application/x-rar-compressed',
            'extension_name' => '.rar',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.c',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.cpp',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.java',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.sql',
            ]
        );


        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.js',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.py',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.l',
            ]
        );

        DB::table('formats')->insert(
            [
                'mime_type' => 'plain/text',
                'extension_name' => '.y',
            ]
        );

    }
}
