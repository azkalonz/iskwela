<?php

namespace App\Gateways;

use \App\Models\Questionnaire;
use \App\Models\Question;
use \App\Models\QuestionnaireQuestion;

class QuestionnaireBuilderGateway
{
    protected $questionnaire;
    protected $questions;
    protected $question_mapping;
    protected $user;

    public function __construct()
    {
        $this->questions = collect();
        $this->question_mapping = collect();
        $this->user = \Auth::user();
    }

    public function setQuestionnaireDetails(Array $params)
    {
        if(isset($params['id'])) {
            $this->questionnaire = Questionnaire::find($params['id']);
        }
        else {
            $this->questionnaire = new Questionnaire();
        }

        $this->questionnaire->title = $params['title'];
        $this->questionnaire->instruction = $params['intro'];
        $this->questionnaire->created_by = $this->user->id;
        $this->questionnaire->school_id = $this->user->school_id;
        $this->questionnaire->subject_id = $params['subject_id'];

        $this->setQuestionDetails($params['questions']);
    }

    public function setQuestionDetails(Array $questions)
    {
        $questions = collect($questions)->map(function($q) {
            $q_data =[
                'question' => $q['question'],
                'question_type' => $q['question_type'],
                'question_image' => $q['media_url']
            ];

            switch($q['question_type'])
            {
                case 'mcq':
                default:
                //populate choices
                $col_idx = 1;
                foreach($q['choices'] as $c) {
                    $op_col = 'option_'.$col_idx;
                    $ans_col = 'answer_'.$col_idx;

                    $q_data[$op_col] = $c['option'];
                    $q_data[$ans_col] = $c['is_correct'];

                    $col_idx++;
                }
                break;
            }

            $this->questions->push($q_data);

            $this->question_mapping->push([
                'weight' => $q['weight']
            ]);
        });
    }

    public function save()
    {
        if($this->questionnaire->save()) {
            $this->saveQuestions();
            $this->mapQuestionnaireQuestions();
        }
    }

    public function saveQuestions()
    {
        $qm_arr = $this->question_mapping->toArray();
        $q_arr = collect();
        for($i = 0; $i < count($this->questions); $i++) {
            $question = Question::create($this->questions[$i]);
            $q_arr->push($question);

            // sets the question_mapping data
            $qm_arr[$i]['question_id'] = $question->id;
            $qm_arr[$i]['questionnaire_id'] = $this->questionnaire->id;
        }

        $this->questions = $q_arr;
        $this->question_mapping = collect($qm_arr);
    }

    public function mapQuestionnaireQuestions()
    {
        return QuestionnaireQuestion::insert($this->question_mapping->toArray());
    }

    public function getQuiz()
    {
        return $this->questionnaire;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function getQuestionWeights()
    {
        return $this->question_mapping;
    }
}