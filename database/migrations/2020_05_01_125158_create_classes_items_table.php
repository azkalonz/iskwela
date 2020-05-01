<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_items', function (Blueprint $table) {
            // TODO: reconsider if BIG INT is enough for id, this table will get populated really fast because of itemable.
            $table->bigIncrements('id');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes');
            $table->morphs('itemable'); // combo of itemable_type and itemable_id column; an item can be of type quiz, activity, material, etc.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_items');
    }
}
