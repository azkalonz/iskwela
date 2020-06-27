<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivityQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activity_questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_activity_id');
            $table->integer('questionnaire_id');
            
            $table->unique(['student_activity_id', 'questionnaire_id'], 'sta_id_q_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activity_questionnaires');
    }
}
