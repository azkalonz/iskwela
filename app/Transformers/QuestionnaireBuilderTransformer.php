<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class QuestionnaireBuilderTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['questions'];
    public function transform(\App\Gateways\QuestionnaireBuilderGateway $quiz_builder)
    {
		$quiz = $quiz_builder->getQuiz();
		return [
			'id' => $quiz->id,
			'title' => $quiz->title,
			'intro' => $quiz->instruction,
			'subject_id' => $quiz->subject_id
		];
	}

	public function includeQuestions(\App\Gateways\QuestionnaireBuilderGateway $quiz_builder)
    {
        return $this->collection($quiz_builder->getQuestions(), new \App\Transformers\Question\QuestionTransformer);
    }
}