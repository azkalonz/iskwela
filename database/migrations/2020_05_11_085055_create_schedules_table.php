<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('class_id');
			$table->integer('teacher_id');
            $table->datetime('date_from');
            $table->datetime('date_to');
			$table->time('started_at');
			$table->time('ended_at');
			$table->integer('status')->default(2); /*0 - canceled, 1 - on going, 2 - not started*/

            $table->timestamp('created_at')->useCurrent();
            $table->index('class_id');
            $table->unique(['date_from', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
