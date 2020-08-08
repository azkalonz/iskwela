<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AttendanceReportDataTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\AttendanceReportData $data)
    {

        $students = $data->students->map(function($stud) use ($data){
            return [
                'id' => $stud->user_id,
                'first_name' => $stud->user->first_name,
                'last_name' => $stud->user->last_name,
                'attendance' => $stud->attendance_count,
                'absence' => $data->attendance_count - $stud->attendance_count
            ];
        });

        return [
            'class_id' => $data->class_id,
            'class_attendance_count' => $data->attendance_count,
            'students' => $students
        ];
    }
}