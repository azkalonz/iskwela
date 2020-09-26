<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE OR REPLACE VIEW student_answers_v AS
        SELECT sar.batch, sar.activity_id, sar.user_id
            , sar.questionnaire_id
            , sar.score, sar.perfect_score
            , saa.question_id
            , saa.is_correct
            , saa.answer
        FROM student_activity_records sar
        , student_activity_answers saa
        WHERE saa.record_id = sar.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_answers_v');
    }
}
