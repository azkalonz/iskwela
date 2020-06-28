<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectGradingCategory extends Model
{
    use SoftDeletes;
	protected $table = 'subject_grading_categories';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    
}