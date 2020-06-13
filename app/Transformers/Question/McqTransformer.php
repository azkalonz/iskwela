<?php

namespace App\Transformers\Question;

use League\Fractal\TransformerAbstract;

class McqTransformer extends BaseQuestionDataTransformer
{
    private $choices_cols = [
        'option_1' => 'answer_1',
        'option_2' => 'answer_2',
        'option_3' => 'answer_3',
        'option_4' => 'answer_4',
        'option_5' => 'answer_5',
    ];
    public function transform(\App\Models\Question $question)
    {
        $result = parent::transform($question);
        $result['choices'] = $this->transformChoices($question);
        
        return $result;
    }
    
    public function transformChoices(\App\Models\Question $question)
    {
        $choices = [];
        foreach($this->choices_cols as $option => $answer) {
            if(isset($question->$option)) {
                array_push($choices, 
                            [
                                'option' => $question->$option,
                                'is_correct' => $question->$answer
                            ]
                );
            }
        }

        return $choices;
    }
}