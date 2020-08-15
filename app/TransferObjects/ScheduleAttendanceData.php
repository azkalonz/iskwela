<?php

namespace App\TransferObjects;

class ScheduleAttendanceData extends TransferObjectAbstract
{
    protected $class_id;
    protected $schedule_id;
    protected $attendance_records;
    protected $from;
    protected $to;

    public function __construct(
        int $class_id,
        int $schedule_id,
        int $attendance_records,
        int $to,
        string $from)
    {
        $this->class_id = $class_id;
        $this->schedule_id = $schedule_id;
        $this->attendance_records = $attendance_records;
        $this->reason = $to;
        $this->reason = $from;
    }
}
