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
        'school_id',
        'created_by',
        'change_password_required',
        'updated_by'
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
		return $this->hasOne(UserPreference::class, 'user_id', 'id');
    }

    /**
     * Get the school where the user belongs to.
     */
    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }

    public function activityRecords()
    {
        return $this->hasMany(StudentActivityRecord::class, 'user_id');
    }

    public function scopeInClass($builder, int $class_id)
    {
        return $builder->whereIn('users.id', function($query) use ($class_id) {
            $query->from((new SectionStudent)->getTable())
                ->select('user_id')
                ->join('sections', function($join) use ($class_id) {
                    $join->on('sections_students.section_id', '=', 'sections.id');
                })
                ->join('classes', function($join) use ($class_id) {
                    $join->on('sections.id', '=', 'classes.section_id')
                         ->where('classes.id', '=', $class_id);
                });
        });
    }

    public function isTeacher() {
        return ($this->user_type == UserType::TEACHER);
    }

    public function isStudent() {
        return ($this->user_type == UserType::STUDENT);
    }
    
    public function scoreReport()
    {
        return $this->hasMany(ScoreReportRecordView::class, 'user_id');
    }

    public function children()
    {
        return $this->hasMany(StudentParent::class, 'parent_id', 'id');
    }

    public function scopeAttendances($builder, int $class_id, int $user_id)
    {
        return $builder->join('sections_students', function($join) use ($class_id, $user_id) {
            $join->on('sections_students.user_id', '=', 'users.id')
                 ->where('sections_students.user_id', '=', $user_id);
        })
        ->join('classes', function($join) use ($class_id) {
            $join->on('classes.section_id', '=', 'sections_students.section_id')
                 ->where('classes.id','=', $class_id);
        })
        ->join('schedules', function($join) use ($class_id) {
            $join->on('schedules.class_id', '=', 'classes.id')
                 ->where('schedules.class_id', '=', $class_id);
        })
        ->leftJoin('attendances', function($join) use ($user_id) {
            $join->on('attendances.schedule_id', '=', 'schedules.id')
                 ->where('attendances.user_id', '=', $user_id);
        });
    }
}
