<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ScoreReportViewTransformer extends TransformerAbstract
{
    public function transform(\App\Models\ScoreReportRecordView $score)
    {
      return [
        'activity_id' => $score->activity_id,
        'student_id' => $score->user_id,
        'first_name' => $score->first_name,
        'last_name' => $score->last_name,
        'perfect_score' => $score->perfect_score,
        'achieved_score' => (int)$score->achieved_score,
        'achieved_score_percent' => round((int)$score->achieved_score / (int)$score->perfect_score, 3),
        'attempts' => (int)$score->attempts
      ];
    }
}