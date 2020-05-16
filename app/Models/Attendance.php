<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /**
    * @return Relation
    */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }  
}
