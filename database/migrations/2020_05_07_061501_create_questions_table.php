<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('question');
            $table->string('question_type', 20);
            $table->string('question_image');
            $table->mediumText('option_1');
            $table->mediumText('option_2');
            $table->mediumText('option_3');
            $table->mediumText('option_4');
            $table->mediumText('option_5');
            $table->integer('answer_1');
            $table->integer('answer_2');
            $table->integer('answer_3');
            $table->integer('answer_4');
            $table->integer('answer_5');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('questions');
    }
}
