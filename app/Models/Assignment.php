<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
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
}
