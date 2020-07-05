<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityAnswer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'record_id',
        'question_id',
        'status',
        'answer'
    ];
}
