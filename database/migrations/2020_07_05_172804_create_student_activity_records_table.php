<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivityRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activity_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('activity_id');
            $table->integer('questionnaire_id');
            $table->integer('school_id');
            $table->integer('subject_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('score');
            $table->integer('perfect_score');
            $table->timestamp('created_at');

            $table->index(['user_id', 'activity_id']);
            $table->index('questionnaire_id');
            $table->index('school_id');
            $table->index('start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activity_records');
    }
}
