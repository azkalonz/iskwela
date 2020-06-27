<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SchoolGradingCategoryTransformer extends TransformerAbstract
{
    public function transform(\App\Models\SchoolGradingCategory $grading_category)
    {
		return [
			'id' => $grading_category->id,
            'school_id' => $grading_category->school_id,
            'category' => $grading_category->category,
            'category_percentage' => $grading_category->category_percentage
		];
    }
}