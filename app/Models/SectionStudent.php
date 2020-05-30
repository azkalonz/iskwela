<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{
    protected $table = 'sections_students';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id');
    }

    public function submittedActivity()
    {
        return $this->hasMany(AssignmentAnswer::class, 'student_id', 'user_id');
    }
}
