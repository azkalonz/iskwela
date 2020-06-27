<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['questionnaires'];

    public function transform(\App\Models\StudentActivity $student_activity)
    {
		//dd($student_activity->questionnaires);
		return [
			'id' => $student_activity->id,
			'title' => $student_activity->title,
			'instruction' => $student_activity->instruction,
			'duration' => $student_activity->duration
			//add category
			//add subject

		];
	}

	public function includeQuestionnaires(\App\Models\StudentActivity $student_activity)
    {
        return $this->collection($student_activity->questionnaires, new \App\Transformers\QuestionnaireTransformer);
    }
}