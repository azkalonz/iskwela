<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    public $timestamps = true;
	protected $table = 'users_preferences';
	
	protected $fillable = ['user_id'];
}
