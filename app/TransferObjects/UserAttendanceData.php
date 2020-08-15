<?php

namespace App\TransferObjects;

class UserAttendanceData extends TransferObjectAbstract
{
    protected $class_id;
    protected $schedule_id;
    protected $attendance_status;
    protected $reason;
    protected $from;
    protected $to;

    public function __construct(
        int $class_id,
        int $schedule_id,
        int $attendance_status,
        int $reason,
        int $to,
        string $from)
    {
        $this->class_id = $class_id;
        $this->schedule_id = $schedule_id;
        $this->attendance_status = $attendance_status;
        $this->reason = $reason;
        $this->reason = $to;
        $this->reason = $from;
    }
}
