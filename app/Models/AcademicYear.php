<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'school_id',
        'date_from',
        'date_to'
    ];
}
