<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(SectionsStudentsSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(TopicsSeeder::class);
        $this->call(YearsSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ClassesMaterialsSeeder::class);
        $this->call(AssignmentsSeeder::class);
        $this->call(AssignmentsQuestionsSeeder::class);
        $this->call(AssignmentsMaterialsSeeder::class);
        $this->call(AssignmentsViewersSeeder::class);
        $this->call(AttendancesSeeder::class);
        $this->call(SchoolsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CommentsSeeder::class);
    }
}
