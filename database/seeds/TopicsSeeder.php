<?php

use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/artifacts/topics.sql';
        DB::unprepared(file_get_contents($path));
    }
}
