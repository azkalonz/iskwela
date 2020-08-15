<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScheduleAttendanceDataTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\ScheduleAttendanceData $data)
    {
        return [
            'class_id' => $data->schedule_id,
            'schedule_id' => $data->schedule_id,
            'from' => $data->from,
            'to' => $data->to,
            'attendance_records' => $data->attendance_records
        ];
    }
}