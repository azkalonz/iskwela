<?php

namespace App\Transformers\Question;

use League\Fractal\TransformerAbstract;
use \App\Models\Question;

class BaseQuestionDataTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Question $question)
    {
		$data = [
            'id' => $question->id,
            'question' => $question->question,
            'question_type' => $question->question_type,
            'media_url' => $question->question_image,
            'weight' => $question->mapping->weight
        ];

        return $data;
	}
}