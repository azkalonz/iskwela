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
        'created_by',
        'updated_by',
        'subject_id',
        'section_id',
        'year_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'frequency',
        'color'
    ];

    public const WEEKDAYS = [
        'su' => 0,
        'm' => 1,
        't' => 3,
        'w' => 3,
        'th' => 4,
        'f' => 5,
        'sa' => 6
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

    public function students()
    {
/*         $sql = $this->hasManyThrough(User::class, SectionStudent::class, 'user_id', 'id', 'id', 'user_id')->toSql();

        dd($sql); */

        return $this->hasManyThrough(User::class, SectionStudent::class, 'user_id', 'id', 'id', 'user_id');
    }

    /**
     * Classes will have posts, but posts can be owned by classes or other models.
     * This is why it is implemented as itemable.
     */
    public function posts() {
        return $this->morphMany('App\Models\Post', 'itemable');
    }
}
