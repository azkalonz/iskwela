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
    protected $questions_to_edit;
    protected $questions_to_edit_mapping;

    public function __construct()
    {
        $this->questions = collect();
        $this->questions_to_edit = collect();
        $this->questions_to_edit_mapping = collect();
        $this->question_mapping = collect();
        $this->user = \Auth::user();
    }

    public function setQuestionnaireDetails(Array $params)
    {
        if(isset($params['questionnaire_id'])) {
            $this->questionnaire = Questionnaire::find($params['questionnaire_id']);
            if(!$this->questionnaire) {
                exit('Error editing questionnaire');
            }
        }
        else {
            $this->questionnaire = new Questionnaire();
        }

        $this->questionnaire->title = $params['title'];
        $this->questionnaire->instruction = isset($params['intro']) ? $params['intro'] : "";
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

            $update = FALSE;

            if(isset($q['question_id'])) {
                $questionnaireQuestion = QuestionnaireQuestion::whereQuestionId($q['question_id'])->whereQuestionnaireId($this->questionnaire->id)->first();
                if($questionnaireQuestion)
                {
                    $update = TRUE;
                }
            }

            if($update){
                $q_data['id'] = $q['question_id'];
                $this->questions_to_edit->push($q_data);
                $this->questions_to_edit_mapping->push([
                    'weight' => $q['weight']
                ]);
            }
            else {
                $this->questions->push($q_data);
                $this->question_mapping->push([
                    'weight' => $q['weight']
                ]);
            }
        });

       // dd($this->question_mapping);
    }

    public function save()
    {
        if($this->questionnaire->save()) {
            $this->saveQuestions();
        }
    }

    public function saveQuestions()
    {
        $q_arr = collect();
        // save the new questions
        if($this->question_mapping) {
            $qm_arr = $this->question_mapping->toArray();
            for($i = 0; $i < count($this->questions); $i++) {
                $question = Question::create($this->questions[$i]);
                $q_arr->push($question);
    
                // sets the question_mapping data
                $qm_arr[$i]['question_id'] = $question->id;
                $qm_arr[$i]['questionnaire_id'] = $this->questionnaire->id;
            }

            $this->question_mapping = collect($qm_arr);
            $this->mapQuestionnaireQuestions($this->question_mapping);
        }

        // edit the existing questions

        if($this->questions_to_edit) {
            $qm_arr = $this->questions_to_edit_mapping->toArray();
            $this->questions_to_edit->map(function($q, $index) use ($qm_arr, &$q_arr) {
                $question = Question::find($q['id']);

                // in case the weight is updated
                $qmap = QuestionnaireQuestion::whereQuestionId($q['id'])->whereQuestionnaireId($this->questionnaire->id)->first();
                $qmap->weight = $qm_arr[$index]['weight'];
                $qmap->save();

                //remove the id from the array
                unset($q['id']);

                foreach($q as $field => $value) {
                    $question->$field = $value;
                }
                $question->save();
                $q_arr->push($question);
            });
        }

        //collect all the questions
        $this->questions = $q_arr;

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
