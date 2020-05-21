<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->mediumText('instruction');
            $table->integer('class_id');
            $table->integer('schedule_id');
            $table->integer('subject_id');
            $table->integer('created_by');
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
            $table->integer('published')->default(0);
            $table->integer('activity_type')->default(1); //1-class activity, 2-assignment
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('deleted_at');
            $table->index(['class_id', 'schedule_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
