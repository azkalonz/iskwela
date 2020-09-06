<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityGatewayTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['questionnaires'];

    public function transform(\App\Gateways\StudentActivityGateway $gw)
    {
		return [
			'id' => $gw->getActivity()->id,
			'score' => $gw->getOverAllStudentScore(),
			'score_percentage' => round(($gw->getOverAllStudentScore()/$gw->getOverallPerfectScore()),2),
			'pefect_score' => (Integer)$gw->getOverallPerfectScore(),
			'duration' => $gw->getDuration()
		];
	}

	public function includeQuestionnaires(\App\Gateways\StudentActivityGateway $gw)
    {
        return $this->collection($gw->getRecords(), new \App\Transformers\StudentActivityRecordTransformer);
	}
}