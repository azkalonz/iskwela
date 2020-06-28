<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SubjectGradingCategoryTransformer extends TransformerAbstract
{
    public function transform(\App\Models\SubjectGradingCategory $grading_category)
    {
		return [
			'id' => $grading_category->id,
            'subject_id' => $grading_category->subject_id,
            'category_id' => $grading_category->category_id,
            'category_percentage' => $grading_category->category_percentage
		];
    }
}