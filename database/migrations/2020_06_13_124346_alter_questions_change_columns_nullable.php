<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterQuestionsChangeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('question_image')->nullable()->change();
            $table->mediumText('option_1')->nullable()->change();
            $table->mediumText('option_2')->nullable()->change();
            $table->mediumText('option_3')->nullable()->change();
            $table->mediumText('option_4')->nullable()->change();
            $table->mediumText('option_5')->nullable()->change();
            $table->integer('answer_1')->nullable()->change();
            $table->integer('answer_2')->nullable()->change();
            $table->integer('answer_3')->nullable()->change();
            $table->integer('answer_4')->nullable()->change();
            $table->integer('answer_5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
