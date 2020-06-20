<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class QuizTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['questions'];
    public function transform(\App\Models\Quiz $quiz)
    {
		return [
			'id' => $quiz->id,
			'title' => $quiz->title,
			'intro' => $quiz->instruction,
			'subject_id' => $quiz->subject_id,
			'school_published' => $quiz->school_published,
			'school_published_date' => $quiz->school_published_date,
			'author' => [
				'id' => $quiz->author->id,
				'first_name' => $quiz->author->first_name,
				'last_name' => $quiz->author->last_name
			]
		];
	}

	public function includeQuestions(\App\Models\Quiz $quiz)
    {
        return $this->collection($quiz->questions, new \App\Transformers\Question\QuestionTransformer);
    }
}