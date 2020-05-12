<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
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
