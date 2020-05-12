<?php

use Illuminate\Database\Seeder;

class ClassesMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/classes_materials.sql';
        DB::unprepared(file_get_contents($path));
    }
}
