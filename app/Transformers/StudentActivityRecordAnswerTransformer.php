<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityRecordAnswerTransformer extends TransformerAbstract
{
    public function transform(\App\Models\StudentActivityAnswer $saa)
    {
		return [
			'id' => $saa->id,
			'question_id' => $saa->question_id,
			'status' => $saa->status,
			'is_correct' => $saa->is_correct,
			'answer' => $saa->answer
		];
	}
}