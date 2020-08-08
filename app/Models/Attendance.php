<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['class_id', 'user_id', 'schedule_id', 'reason', 'status'];
    public $timestamps = true;
    /**
    * @return Relation
    */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    } 
}
