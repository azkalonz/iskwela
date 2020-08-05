<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getDateFromAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d', $value);
        }

        return $value;
    }

    public function getDateToAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d', $value);
        }

        return $value;
    }
}
