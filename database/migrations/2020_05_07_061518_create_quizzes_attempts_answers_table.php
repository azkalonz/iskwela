<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesAttemptsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_attempts_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attempt_id');
            $table->integer('question_id');
            $table->text('answer')->nullable();
            $table->timestamp('created_at');

            $table->index('attempt_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes_attempts_answers');
    }
}
