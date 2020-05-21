<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['materials'];

    public function transform(\App\Models\Assignment $assignment)
    {
        return [
            'id' => $assignment->id,
            'title' => $assignment->title,
            'description' => $assignment->instruction,
            'activity_type' => config('school_hub.activity_type')[$assignment->activity_type],
            'available_from' => $assignment->available_from,
            'available_to' => $assignment->available_to,
            'status' => config('school_hub.activity_status')[$assignment->published]
        ];
    }

    // disabled for now
    public function includeQuestions(\App\Models\Assignment $assignment)
    {
        return $this->collection($assignment->questions, new \App\Transformers\AssignmentQuestionTransformer);
    }

    public function includeMaterials(\App\Models\Assignment $assignment)
    {
        return $this->collection($assignment->materials, new \App\Transformers\AssignmentMaterialTransformer);
    }
    /* public function includeQuizzes(\App\Models\Assignment $assignment)
    {
        return $this->collection($assignment->quizzes, new \App\Transformers\AssignmentQuizTransformer);
    } */
}