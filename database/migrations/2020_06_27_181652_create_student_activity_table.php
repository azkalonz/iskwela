<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->mediumText('instruction')->nullable();
            $table->integer('created_by');
            $table->integer('school_id');
            $table->integer('subject_id');
            $table->integer('category_id');
            $table->integer('duration');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('created_by');
            $table->index('school_id');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activities');
    }
}
