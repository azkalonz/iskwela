<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class QuizBuilderTransformer extends TransformerAbstract
{
    public function transform(\App\Gateways\QuizBuilderGateway $quiz_builder)
    {
		$quiz = $quiz_builder->getQuiz();
		$questions = $quiz_builder->getQuestions();
		$question_weights = $quiz_builder->getQuestionWeights();
		return [
			'id' => $quiz->id,
			'title' => $quiz->title,
			'intro' => $quiz->instruction,
			'subject_id' => $quiz->subject_id,
		];
	}
}