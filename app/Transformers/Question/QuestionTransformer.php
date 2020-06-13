<?php

namespace App\Transformers\Question;

use League\Fractal\TransformerAbstract;
use \App\Models\Question;

class QuestionTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Question $question)
    {
		switch ($question->question_type) {
            case Question::TYPE_MCQ:
			default:
                return (new McqTransformer)->transform($question);
        }
	}
}