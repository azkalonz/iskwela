<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentScoreGatewayTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\StudentScoreData $ssd)
    {
		return [
			'id' => $ssd->id,
			'username' => $ssd->username,
			'first_name' => $ssd->first_name,
			'last_name' => $ssd->last_name,
			'scores' => $ssd->scores
		];
	}
}