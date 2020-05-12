<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['questions', 'materials'];

    public function transform(\App\Models\Assignment $assignment)
    {
        return [
            'id' => $assignment->id,
            'title' => $assignment->title,
            'instruction' => $assignment->instruction,
            'available_from' => $assignment->available_from,
            'available_to' => $assignment->available_to,
        ];
    }

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