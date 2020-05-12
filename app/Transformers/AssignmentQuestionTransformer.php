<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentQuestionTransformer extends TransformerAbstract
{
    public function transform(\App\Models\AssignmentQuestion $assignment_question)
    {
        return [
            'id' => $assignment_question->id,
            'question' => $assignment_question->question
        ];
    }
}