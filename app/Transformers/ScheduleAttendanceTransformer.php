<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScheduleAttendanceTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['attendances'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(\App\Models\Schedule $schedule)
    {
        return [
            'schedule_id' => $schedule->id,
            'date' => $schedule->date,
            'status' => config('school_hub.schedule_status')[0],
            'is_active' => ($schedule->date == date('Y-m-d')) ? true : false,
        ];
    }

    public function includeAttendances(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->attendances, new \App\Transformers\AttendanceTransformer);
    }
}