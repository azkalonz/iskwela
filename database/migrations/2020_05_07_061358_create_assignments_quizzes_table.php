<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assignment_id');
            $table->integer('quiz_id');
            $table->timestamp('created_at');

            $table->index(['assignment_id', 'quiz_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_quizzes');
    }
}
