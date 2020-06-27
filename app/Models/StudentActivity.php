<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivity extends Model
{
    use SoftDeletes;

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'student_activity_questionnaires', 'student_activity_id', 'questionnaire_id');
    }
}
