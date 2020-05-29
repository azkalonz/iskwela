<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonPlan extends Model
{
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
