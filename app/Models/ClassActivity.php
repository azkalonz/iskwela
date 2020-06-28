<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassActivity extends Model
{
    public $timestamps = false;
    protected $fillable = ['student_activity_id', 'class_id', 'published_by', 'published_at'];
}
