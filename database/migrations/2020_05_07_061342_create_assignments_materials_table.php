<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assignment_id');
            $table->string('resource', 255);
            $table->timestamp('created_at');

            $table->index('assignment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_materials');
    }
}
