<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentImprovementTransformer extends TransformerAbstract
{
    public function transform(\App\Models\StudentImprovement $student_improvement)
    {
        return [
			'id' => $student_improvement->id,
            'improvement' => $student_improvement->improvement,
			'student' => [
				'student_id' => $student_improvement->student->id,
				'first_name' => $student_improvement->student->first_name,
				'last_name' => $student_improvement->student->last_name
			],
            'class' => [
				'id' => $student_improvement->classes->id,
				'name' => $student_improvement->classes->name
			]

        ];
    }
}