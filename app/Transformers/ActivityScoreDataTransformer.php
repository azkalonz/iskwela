<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ActivityScoreDataTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\ActivityScoreData $ssd)
    {
		return [
			'id' => $ssd->id,
			'published_at' => $ssd->published_at,
			'title' => $ssd->title,
			'perfect_score' => $ssd->perfect_score,
			'student_score' => $ssd->total_score ?? 0,
			'rating' => $ssd->rating ?? 0
		];
	}
}