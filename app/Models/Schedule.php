<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function materials()
    {
        return $this->hasMany(ClassMaterial::class);
    }
}
