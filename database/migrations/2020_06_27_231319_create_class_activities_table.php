<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('class_quizzes');

        Schema::create('class_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_activity_id');
            $table->integer('class_id');
            $table->integer('schedule_id');
            $table->integer('published_by');
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->unique(['student_activity_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_activities');
    }
}
