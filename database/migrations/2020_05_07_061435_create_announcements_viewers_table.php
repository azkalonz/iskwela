<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsViewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements_viewers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('announcement_id');
            $table->integer('class_id');
            $table->timestamp('created_at');

            $table->index(['announcement_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements_viewers');
    }
}
