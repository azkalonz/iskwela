<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class YearTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Year $year)
    {
		return [
			'id' => $year->id,
            'name' => $year->name
		];
    }
}