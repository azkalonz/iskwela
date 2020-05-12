<?php

use Illuminate\Database\Seeder;

class AssignmentsMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/assignments_materials.sql';
        DB::unprepared(file_get_contents($path));
    }
}
