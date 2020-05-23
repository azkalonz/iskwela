<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assignment_id');
            $table->integer('assignment_question_id')->default(0);
            $table->integer('student_id');
            $table->mediumText('answer_text');
            $table->mediumText('answer_media');
            $table->timestamp('created_at');

            $table->index('assignment_id');
            $table->index('student_id');
            $table->index('assignment_question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_answers');
    }
}
