<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentActivityTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['category'];
	protected $availableIncludes = ['questionnaires'];

    public function transform(\App\Models\StudentActivity $student_activity)
    {
		$data = [
			'id' => $student_activity->id,
			'title' => $student_activity->title,
			'instruction' => $student_activity->instruction,
			'duration' => $student_activity->duration,
			'activity_availability_status' => config('school_hub.activity_availablity')[$student_activity->availability_status],
			'subject' => [
				'id' => $student_activity->subject->id,
				'subject_name' => $student_activity->subject->name
			],
			'published' => ($student_activity->classActivity->draft) ? false : true
			//add subject
		];

		if ((\Auth::user())->user_type == 's') {
			$status = $student_activity->status ? : 0;
			$data['submission_status'] = config('school_hub.activity_submission')[$status];
			$data['submission_date'] = $student_activity->submitted_date;
		}
		return $data;
	}

	public function includeQuestionnaires(\App\Models\StudentActivity $student_activity)
    {
        return $this->collection($student_activity->questionnaires, new \App\Transformers\QuestionnaireTransformer);
	}

	public function includeCategory(\App\Models\StudentActivity $student_activity)
    {
        return $this->item($student_activity->category, new \App\Transformers\SchoolGradingCategoryTransformer);
	}
}