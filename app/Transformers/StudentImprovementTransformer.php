<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentImprovementTransformer extends TransformerAbstract
{
    public function transform(\App\Models\classes $classes)
    {
		return [
			'class_id' => $classes->id,
			'class_name' => $classes->name,
			'student_id' => $classes->student_id,
			'student_first_name' => $classes->first_name,
			'student_last_name' => $classes->last_name,
			'improvement' => $classes->improvement
		];
    }
}