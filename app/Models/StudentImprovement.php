<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentImprovement extends Model
{
	protected $table = 'students_improvements';
    public $timestamps = true;
    
	public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }

}
