<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quiz_id');
            $table->integer('question_id');
            $table->integer('weight');

            $table->index('quiz_id');
            $table->index('question_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes_questions');
    }
}
