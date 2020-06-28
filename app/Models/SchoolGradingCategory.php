<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolGradingCategory extends Model
{
    use SoftDeletes;
	protected $table = 'school_grading_categories';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    
}