<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ClassesTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['schedules', 'students'];
    protected $defaultIncludes = ['section', 'year'];

    public function transform(\App\Models\Classes $class)
    {
        $next_schedule = $this->getNextSchedule($class->schedules->toArray());
        return [
            'id' => $class->id,
            'name' => $class->name,
            'description' => $class->description,
            'bg_image' => $class->image,
            'room_number' => $class->room_number,
            'frequency' => strtoupper($class->frequency),
            'date_from' => $class->date_from,
            'date_to' => $class->date_to,
            'time_from' => $class->time_from,
            'time_to' => $class->time_to,
            'next_schedule' => $next_schedule,
            'color' => $class->color,
            'subject' => [
                'id' => $class->subject->id,
                'name' => $class->subject->name
            ],
            'teacher' => [
                'id' => $class->teacher->id,
                'first_name' => $class->teacher->first_name,
                'last_name' => $class->teacher->last_name,
                'profile_picture' => ($class->teacher->preference) ? $class->teacher->preference->profile_picture : ""
            ]
        ];
    }

    public function includeSchedules(\App\Models\Classes $class)
    {
        return $this->collection($class->schedules, new \App\Transformers\ScheduleTransformer);
    }

    public function includeSection(\App\Models\Classes $class)
    {
        return $this->item($class->section, new \App\Transformers\SectionTransformer);
    }

    public function includeYear(\App\Models\Classes $class)
    {
        return $this->item($class->year, new \App\Transformers\YearTransformer);
    }

    public function includeStudents(\App\Models\Classes $class)
    {
        return $this->collection($class->sectionStudents, new \App\Transformers\SectionStudentTransformer);
    }

    private function getNextSchedule(Array $schedules)
    {
        $next = [];
        foreach($schedules as $sched)
        {
            $from = date('Y-m-d', strtotime($sched['date_from']));
            $now = date('Y-m-d', strtotime('now'));

            if($now == $from) {
                $next = [
                    'id' => $sched['id'],
                    'from' => $sched['date_from'],
                    'to' => $sched['date_to'],
                    'status' => config('school_hub.schedule_status')[$sched['status']]
                ];
                break;

            }
            continue;
        }
        return $next;
    }
}