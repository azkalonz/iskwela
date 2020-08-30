<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['materials'
            , 'activities'
            , 'publishedSeatworks'
            , 'unpublishedSeatworks'
            , 'publishedAssignments'
            , 'unpublishedAssignments'
            , 'lessonPlans'
            , 'publishedProjects'
            , 'unpublishedProjects'
            , 'seatworks'
            , 'projects'];
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
                'profile_picture' => ($schedule->teacher->preference) ? $schedule->teacher->preference->profile_picture : ""
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

    public function includePublishedSeatworks(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->publishedSeatworks, new \App\Transformers\AssignmentTransformer);
    }

    public function includeUnpublishedSeatworks(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->unpublishedSeatworks, new \App\Transformers\AssignmentTransformer);
    }

    public function includePublishedAssignments(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->publishedAssignments, new \App\Transformers\AssignmentTransformer);
    }

    public function includeUnpublishedAssignments(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->unpublishedAssignments, new \App\Transformers\AssignmentTransformer);
    }

    public function includeSeatworks(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->seatworks, new \App\Transformers\AssignmentTransformer);
    }

    public function includePublishedProjects(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->publishedProjects, new \App\Transformers\AssignmentTransformer);
    }

    public function includeUnpublishedProjects(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->unpublishedProjects, new \App\Transformers\AssignmentTransformer);
    }

    public function includeProjects(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->projects, new \App\Transformers\AssignmentTransformer);
    }

    public function includeLessonPlans(\App\Models\Schedule $schedule)
    {
        return $this->collection($schedule->lessonPlans, new \App\Transformers\LessonPlanTransformer);
    }
}