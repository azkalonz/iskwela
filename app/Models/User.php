<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\UserPreference;

class User extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'username',
        'gender',
        'password',
        'user_type',
        'school_id'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'sub' => env('JWT_SUB'),
            'key' => $this->id
        ];
    }
    
    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function classes()
    {
        return $this->hasManyThrough(Classes::class, SectionStudent::class, 'user_id', 'section_id', 'id', 'section_id');
    }
	
	public function preference()
	{
		return $this->hasMany(UserPreference::class, 'user_id', 'id');
	}
	
}
