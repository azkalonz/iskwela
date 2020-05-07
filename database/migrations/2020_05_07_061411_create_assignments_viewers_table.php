<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsViewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_viewers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assignment_id');
            $table->integer('user_id');
            $table->timestamp('created_at');
            
            $table->index('assignment_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_viewers');
    }
}
