<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{

    protected $table = 'sections_students';

    protected $fillable = ['section_id', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id');
    }

    public function submittedActivity()
    {
        return $this->hasMany(AssignmentAnswer::class, 'student_id', 'user_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
