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
}
