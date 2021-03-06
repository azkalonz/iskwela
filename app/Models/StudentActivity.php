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

    public function category()
    {
        return $this->belongsTo(SchoolGradingCategory::class, 'category_id');
    }

    public function scopeInClass($builder, $teacher_id = null, $class_id = null, $all = false)
    {
        return $builder->whereIn('student_activities.id', function($query) use ($teacher_id, $class_id, $all) {
            $query->from((new ClassActivity)
                ->getTable())
                ->select('student_activity_id');

            if($teacher_id) {
                $query->wherePublishedBy($teacher_id);
            }

            if($class_id) {
                $query->whereClassId($class_id);
            }

            if(!$all) {
                $query->whereDraft(0);
            }

        });
    }

    public function classActivity()
    {
        return $this->hasOne(ClassActivity::class, 'student_activity_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function scopeSubmissionStatus($builder, $user_id)
    {
        return $builder->leftJoin('student_activity_submission', function($join) use ($user_id) {
            $join->on('student_activity_submission.activity_id', '=', 'student_activities.id')
            ->where('student_activity_submission.user_id', '=', $user_id);
        });
    }

    public function scopeStudentRecords($builder, $user_id)
    {
        return $builder->join('student_activity_records', function($join) use ($user_id) {
            $join->on('student_activity_records.activity_id', '=', 'student_activities.id')
            ->where('student_activity_records.user_id', '=', $user_id);
        });
    }
}
