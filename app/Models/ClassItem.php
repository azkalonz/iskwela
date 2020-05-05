<?php

/**
 * Usage:
 * Create a new ClassItem instance (fill the array with your own database fields)
 *   $item = new ClassItem(['name' => 'Foo bar.']);
 * 
 * Find the video to insert into a tag
 *   $quiz = Quiz::find(1);
 * 
 * In the class-item relationship, save a new video
 *   $item->quizzes()->save($quiz);
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Classes;

class ClassItem extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['class_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function classMaterials()
    {
        return $this->morphedByMany('App\Models\ClassMaterial', 'itemable');
    }

    public function quizzes()
    {
        return $this->morphedByMany('Quiz', 'itemable');
    }

    public function activities()
    {
        return $this->morphedByMany('Activity', 'itemable');
    }

    public function assignments()
    {
        return $this->morphedByMany('Assignment', 'itemable');
    }

    // add lesson plan item
}
