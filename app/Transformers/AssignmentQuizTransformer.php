<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentQuizTransformer extends TransformerAbstract
{
    public function transform(\App\Models\AssignmentQuiz $assignment_quiz)
    {
        return [
            'id' => $assignment_question->id,
            'question' => $assignment_question->question
        ];
    }
}