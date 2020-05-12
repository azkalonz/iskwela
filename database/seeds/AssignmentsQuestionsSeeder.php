<?php

use Illuminate\Database\Seeder;

class AssignmentsQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/assignments_questions.sql';
        DB::unprepared(file_get_contents($path));
    }
}
