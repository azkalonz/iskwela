<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivityAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activity_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('record_id');
            $table->integer('question_id');
            $table->integer('status')->default(0);
            $table->text('answer')->nullable();
            $table->timestamp('created_at');

            $table->index('record_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activity_answers');
    }
}
