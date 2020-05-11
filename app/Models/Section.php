<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * User that is assigned to the class
     */
    public function students()
    {
        return $this->hasMany(SectionStudent::class);
    }
}
