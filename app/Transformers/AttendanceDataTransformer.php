<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AttendanceDataTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\AttendanceData $data)
    {
        return [
            'schedule_id' => $data->schedule_id,
            'status_flag' => $data->attendance_status,
            'remark' => $data->attendance_status ? config('school_hub.attendance_status')[$data->attendance_status] : config('school_hub.attendance_status')[0],
            'from' => $data->from,
            'to' => $data->to,
            'reason' => $data->reason
        ];
    }
}