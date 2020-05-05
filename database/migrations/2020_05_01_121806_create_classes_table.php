<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('year_id')->unsigned();
            $table->char('color', 7); // hex color in #000000 format
            $table->string('image'); // url of the background image
            $table->bigInteger('section_id')->unsigned();
            $table->string('schedule'); // class schedule in cron format
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
