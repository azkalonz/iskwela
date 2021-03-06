<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    const ASSIGNMENT = 3;
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
    public function unpublishedSeatworks()
    {
        return $this->hasMany(Assignment::class)->where('published', 0)->whereActivityType(1);
    }

    public function seatworks()
    {
        return $this->hasMany(Assignment::class)->whereActivityType(1);
    }

    public function publishedProjects()
    {
        return $this->hasMany(Assignment::class)->where('published', 1)->whereActivityType(2);
    }

    public function unpublishedProjects()
    {
        return $this->hasMany(Assignment::class)->where('published', 0)->whereActivityType(2);
    }

    public function publishedAssignments()
    {
        return $this->hasMany(Assignment::class)->where('published', 1)->whereActivityType(self::ASSIGNMENT);
    }

    public function unpublishedAssignments()
    {
        return $this->hasMany(Assignment::class)->where('published', 0)->whereActivityType(self::ASSIGNMENT);
    }

    public function projects()
    {
        return $this->hasMany(Assignment::class)->whereActivityType(2);
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
