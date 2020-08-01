<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityRecord extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'activity_id',
        'user_id',
        'questionnaire_id',
        'school_id',
        'subject_id',
        'start_time',
        'end_time',
        'perfect_score',
        'batch',
        'score'
    ];

    public function answers()
    {
        return $this->hasMany(StudentActivityAnswer::class, 'record_id');
    }

    public function studentActivity()
    {
        return $this->belongsTo(StudentActivity::class, 'activity_id');
    }
}
