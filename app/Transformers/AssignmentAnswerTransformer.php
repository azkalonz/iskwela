<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentAnswerTransformer extends TransformerAbstract
{
    public function transform(\App\Models\AssignmentAnswer $assignment_answer)
    {
        return [
            'id' => $assignment_answer->id,
            'assignment_id' => $assignment_answer->assignment_id,
            'answer_media' =>  ($assignment_answer->answer_media) ? sprintf('%s/api/download/activity/answer/%s', env('APP_URL'), $assignment_answer->id) : "",
        ];
    }

}