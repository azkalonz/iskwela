<?php

use Illuminate\Database\Seeder;

class SectionsStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/sections_students.sql';
        DB::unprepared(file_get_contents($path));
    }
}
