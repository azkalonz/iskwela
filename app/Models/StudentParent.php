<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentParent extends Model
{
    public $timestamps = true;

    public function childInfo()
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }
}