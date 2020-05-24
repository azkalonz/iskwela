<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class LessonPlanTransformer extends TransformerAbstract
{
    public function transform(\App\Models\LessonPlan $lesson_plan)
    {
        return [
            'id' => $lesson_plan->id,
            'title' => $lesson_plan->title,
            'uploaded_file' => ($lesson_plan->file) ? sprintf('%s/api/download/class/material/%s', env('APP_URL'), $lesson_plan->id) : "",
            'resource_link' => $lesson_plan->link_url,
            'added_by' => [
                'id' => $lesson_plan->user->id,
                'first_name' => $lesson_plan->user->first_name,
                'last_name' => $lesson_plan->user->last_name,
            ]
        ];
    }
}