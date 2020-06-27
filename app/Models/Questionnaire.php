<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use SoftDeletes;

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questionnaire_questions', 'questionnaire_id', 'question_id');
    }

    public function scopeSchoolQuizzes($builder)
    {
        return $builder->whereSchoolPublished(1);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublishedToClass($builder, $teacher_id, $class_id = null)
    {
        return $builder->whereIn('questionnaire.id', function($query) use ($teacher_id, $class_id) {
            $query->from((new ClassQuiz)
                ->getTable())
                ->select('questionnaire_id')
                ->wherePublishedBy($teacher_id);

            if($class_id) {
                $query->whereClassId($class_id);
            }
        });
    }
}
