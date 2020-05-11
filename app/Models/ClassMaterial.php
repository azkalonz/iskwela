<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ClassMaterial extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
