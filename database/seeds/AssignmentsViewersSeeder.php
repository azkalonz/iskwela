<?php

use Illuminate\Database\Seeder;

class AssignmentsViewersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/assignments_viewers.sql';
        DB::unprepared(file_get_contents($path));
    }
}
