<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Subject $subject)
    {
		return [
			'id' => $subject->id,
            'name' => $subject->name
		];
    }
}