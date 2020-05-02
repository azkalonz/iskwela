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
        'subject_id',
        'year_id'
    ];

    /**
     * User that is assigned to the class
     */
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This class' subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * This class' year level
     */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    /**
     * User who created this class
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User who updated this class
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the items for the class.
     */
    public function items()
    {
        return $this->morphToMany('App\Models\ClassItem', 'itemable');
    }
}
