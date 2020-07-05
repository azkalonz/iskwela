<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'class_id',
        'teacher_id',
        'date_from',
        'date_to',
        'started_at',
        'ended_at',
    ];

    public $timestamps = false;
    public function materials()
    {
        return $this->hasMany(ClassMaterial::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function publishedSeatworks()
    {
        return $this->hasMany(Assignment::class)->where('published', 1)->whereActivityType(1);
    }

    public function publishedProjects()
    {
        return $this->hasMany(Assignment::class)->where('published', 1)->whereActivityType(2);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function lessonPlans()
    {
        return $this->hasMany(LessonPlan::class);
    }
}
