<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassQuiz extends Model
{
    public $timestamps = false;
    protected $fillable = ['quiz_id', 'class_id', 'published_by', 'published_at'];
}
