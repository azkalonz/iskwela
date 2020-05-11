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
        'created_by',
        'updated_by',
        'teacher_id',
        'subject_id'
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

}
