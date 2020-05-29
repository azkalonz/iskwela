<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AttendanceTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Attendance $attendance)
    {
        return [
            'student_id' => $attendance->users->id,
            'username' => $attendance->users->username,
            'first_name' => $attendance->users->first_name,
            'last_name' => $attendance->users->last_name,
            'user_type' => $attendance->users->user_type,
            'class_id' => $attendance->class_id,
            'schedule' => [
                'id' => $attendance->schedule_id,
                'from' => $attendance->schedule->date_from,
                'to' => $attendance->schedule->date_to,
            ]
        ];
    }
}