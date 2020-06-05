<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    public $timestamps = false;
    protected $table = 'assignments_answers';

    /**
    * @return Relation
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}