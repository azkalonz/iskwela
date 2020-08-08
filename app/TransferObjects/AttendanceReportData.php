<?php

namespace App\TransferObjects;

class AttendanceReportData extends TransferObjectAbstract
{
    protected $class_id;
    protected $attendance_count;
    protected $students;

    public function __construct(
        int $class_id,
        int $attendance_count,
        array $students)
    {
        $this->class_id = $class_id;
        $this->attendance_count = $attendance_count;
        $this->students = $students;
    }
}
