<?php

namespace App\TransferObjects;

class AttendanceData extends TransferObjectAbstract
{
    protected $class_id;
    protected $attendance_count;
    protected $students;

    public function __construct(
        int $class_id,
        int $attendance_count,
        array $students)
    {dd(1);
    }
}
