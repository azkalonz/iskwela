<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->integer('school_id');
            $table->integer('subject_id');
            $table->integer('start_time'); //unixtime
            $table->integer('end_time'); //unixtime
            $table->integer('score');
            $table->integer('perfect_score');
            $table->timestamp('created_at');

            $table->index('user_id');
            $table->index('quiz_id');
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
        Schema::dropIfExists('quizzes_attempts');
    }
}
