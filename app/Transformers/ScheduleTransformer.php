<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['materials', 'activities'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(\App\Models\Schedule $schedule)
    {
        return [
            'id' => $schedule->id,
            'date' => $schedule->date,
            'status' => $schedule->status,
            'is_active' => ($schedule->date == date('Y-m-d')) ? true : false,
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
}