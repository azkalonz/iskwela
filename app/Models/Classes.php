<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class Classes extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'room_number',
        'teacher_id',
        'subject_id',
        'section_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'frequency',
        'color'
    ];

    /**
     * User that is assigned to the class
     */
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * @return Relation
    */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
    * @return Relation
    */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }

        /**
    * @return Relation
    */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    /**
    * @return Relation
    */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    /**
    * @return Relation
    */
    public function sectionStudents()
    {
        return $this->hasMany(SectionStudent::class, 'section_id', 'section_id');
    }

}
