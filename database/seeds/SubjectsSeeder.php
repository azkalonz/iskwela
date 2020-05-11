<?php

use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/subjects.sql';
        DB::unprepared(file_get_contents($path));
    }
}
