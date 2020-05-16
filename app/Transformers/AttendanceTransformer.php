<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AttendanceTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Attendance $attendance)
    {
        return [
            'user_id' => $attendance->users->id,
            'username' => $attendance->users->username,
            'name' => $attendance->users->name,
            'user_type' => $attendance->users->user_type
        ];
    }
}