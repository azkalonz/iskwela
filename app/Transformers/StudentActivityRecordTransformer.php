<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityRecordTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['answers'];

    public function transform(\App\Models\StudentActivityRecord $sar)
    {
		return [
			'questionnaire_id' => $sar->questionnaire_id,
			'activity_record_id' => $sar->id
		];
	}

	public function includeAnswers(\App\Models\StudentActivityRecord $sar)
    {
        return $this->collection($sar->answers, new \App\Transformers\StudentActivityRecordAnswerTransformer);
	}
}