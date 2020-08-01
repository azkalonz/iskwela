<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassActivity extends Model
{
    public $timestamps = false;
    protected $fillable = ['student_activity_id', 'class_id', 'published_by', 'published_at'];

    public function scopeType($builder, int $type, int $class_id,  $user_id)
    {
        return $builder->join('student_activities', function($join) use ($type) {
            $join->on('student_activities.id', 'class_activities.student_activity_id')
                ->where('student_activities.activity_type', '=', $type);
        })
        ->leftJoin('student_activity_records', function($join) use ($user_id) {
            $join->on('student_activity_records.activity_id', 'student_activities.id')
                 ->where('student_activity_records.user_id', '=', $user_id);
        })
        ->where('class_activities.class_id', $class_id);
    }
}
