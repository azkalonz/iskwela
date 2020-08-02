<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = 
            [
                'title',
                'instruction', 
                'class_id', 
                'schedule_id', 
                'subject_id', 
                'created_by', 
                'activity_type', 
                'available_from', 
                'available_to'
            ];
    public function questions()
    {
        return $this->hasMany(AssignmentQuestion::class);
    }

    public function quizzes()
    {
        return $this->hasMany(AssignmentQuiz::class);
    }

    public function materials()
    {
        return $this->hasMany(AssignmentMaterial::class);
    }

    public function viewers()
    {
        return $this->hasManyThrough(SectionStudent::class, Classes::class, 'id', 'section_id');
    }

    public function scopeScore($builder, int $type, int $class_id,  $user_id)
    {
        return $builder->join('student_activity_scores', function($join) use ($user_id) {
            $join->on('student_activity_scores.activity_id', 'assignments.id')
                ->where('student_activity_scores.student_id', '=', $user_id);
        })
        ->where('assignments.activity_type', $type)
        ->where('assignments.class_id', $class_id);
    }
}
