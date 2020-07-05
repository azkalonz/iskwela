<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentActivityScore extends Model
{
    public $timestamps = true;
    protected $fillable = 
        [
            'student_id',
            'activity_id',
            'score',
            'score_percentage',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'
        ];
}
