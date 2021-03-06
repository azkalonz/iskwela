<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('starts')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('ends')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status');
            $table->text('summary');
            $table->string('uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_events');
    }
}
