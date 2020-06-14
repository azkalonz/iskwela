<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['materials'];
    protected $availableIncludes = ['submissions'];

    public function transform(\App\Models\Assignment $assignment)
    {
        return [
            'id' => $assignment->id,
            'title' => $assignment->title,
            'description' => $assignment->instruction,
            'activity_type' => config('school_hub.activity_type')[$assignment->activity_type],
            'available_from' => $assignment->available_from,
            'available_to' => $assignment->available_to,
            'status' => config('school_hub.file_status')[$assignment->published],
            'done' => config('school_hub.boolean_return')[$assignment->done]
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

    public function includeSubmissions(\App\Models\Assignment $assignment)
    {
        return $this->item($assignment->viewers, new \App\Transformers\AssignmentSubmissionsTransformer);
    }
}