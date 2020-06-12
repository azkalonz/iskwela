<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    public $timestamps = false;
    protected $fillable = ['school_name', 'school_code', 'school_logo'];
}
