<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{
    protected $table = 'sections_students';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}