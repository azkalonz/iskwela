<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivitySubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activity_submission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('activity_id');
            $table->integer('user_id');
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activity_submission');
    }
}
