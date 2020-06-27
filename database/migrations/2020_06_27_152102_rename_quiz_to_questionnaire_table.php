<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameQuizToQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('quizzes_questions');
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->mediumText('instruction');
            $table->integer('created_by');
            $table->integer('school_id');
            $table->integer('subject_id');
            $table->integer('school_published')->default(0);
            $table->timestamp('school_published_date')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('created_by');
            $table->index('school_id');
            $table->index('school_published');
            $table->index('deleted_at');
        });

        Schema::create('questionnaire_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('questionnaire_id');
            $table->integer('question_id');
            $table->integer('weight');

            $table->index('questionnaire_id');
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
        Schema::dropIfExists('questionnaires');
    }
}
