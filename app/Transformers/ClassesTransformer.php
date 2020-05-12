<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ClassesTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['schedules', 'students'];

    public function transform(\App\Models\Classes $class)
    {
        return [
            'id' => $class->id,
            'name' => $class->name,
            'description' => $class->description,
            'frequency' => strtoupper($class->frequency),
            'date_from' => $class->date_from,
            'date_to' => $class->date_to,
            'time_from' => $class->time_from,
            'time_to' => $class->time_to,
            'subject' => [
                'id' => $class->subject->id,
                'name' => $class->subject->name
            ],
            'teacher' => [
                'id' => $class->teacher->id,
                'name' => $class->teacher->name,
            ]
        ];
    }

    public function includeSchedules(\App\Models\Classes $class)
    {
        return $this->collection($class->schedules, new \App\Transformers\ScheduleTransformer);
    }

    public function includeStudents(\App\Models\Classes $class)
    {
        return $this->collection($class->section->students, new \App\Transformers\SectionStudentTransformer);
    }
}