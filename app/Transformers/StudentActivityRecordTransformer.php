<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityRecordTransformer extends TransformerAbstract
{
    public function transform(\App\Models\StudentActivityRecord $sar)
    {
		return [
			'id' => $sar->questionnaire_id,
			'answer' => $sar->answers
		];
	}
}