<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityScoreTransformer extends TransformerAbstract
{
    public function transform(\App\Models\StudentActivityScore $activity_score)
    {
        return [
            'id' => $activity_score->id,
            'student_id' => $activity_score->student_id,
            'activity_id' => $activity_score->activity_id,
            'score' =>  $activity_score->score,
            'score_percentage' =>  $activity_score->score_percentage

        ];
    }

}