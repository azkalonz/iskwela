<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['materials', 'activities', 'publishedActivities', 'lessonPlans'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(\App\Models\Schedule $schedule)
    {
        return [
            'id' => $schedule->id,
            'from' => $schedule->date_from,
            'to' => $schedule->date_to,
            'teacher' => [
                'id' => $schedule->teacher->id,
                'first_name' => $schedule->teacher->first_name,
                'last_name' => $schedule->teacher->last_name,
            ],
            'status' => config('school_hub.schedule_status')[$schedule->status],
        ];
    }
    
    public function includeMaterials(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->materials, new \App\Transformers\ClassMaterialTransformer);
    }

    public function includeActivities(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->assignments, new \App\Transformers\AssignmentTransformer);
    }

    public function includePublishedActivities(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->publishedAssignments, new \App\Transformers\AssignmentTransformer);
    }

    public function includeLessonPlans(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->lessonPlans, new \App\Transformers\LessonPlanTransformer);
    }
}