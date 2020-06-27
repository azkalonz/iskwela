<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class QuestionnaireTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['questions'];
    public function transform(\App\Models\Questionnaire $questionnaire)
    {
		return [
			'id' => $questionnaire->id,
			'title' => $questionnaire->title,
			'intro' => $questionnaire->instruction,
			'subject_id' => $questionnaire->subject_id,
			'school_published' => $questionnaire->school_published,
			'school_published_date' => $questionnaire->school_published_date,
			'author' => [
				'id' => $questionnaire->author->id,
				'first_name' => $questionnaire->author->first_name,
				'last_name' => $questionnaire->author->last_name
			]
		];
	}

	public function includeQuestions(\App\Models\Questionnaire $questionnaire)
    {
        return $this->collection($questionnaire->questions, new \App\Transformers\Question\QuestionTransformer);
    }
}