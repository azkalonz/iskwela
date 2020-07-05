<?php

namespace App\Gateways;

use App\Models\StudentActivityRecord;
use App\Models\StudentActivityAnswer;
use App\Models\StudentActivity;
use App\Models\Questionnaire;


class StudentActivityGateway
{
    protected $records;
    protected $question_weights;
    protected $user;
    protected $activity;

    public function __construct()
    {
        $this->records = collect();
        $this->user = \Auth::user();
    }

    public function save()
    {
        try {
            $this->records = $this->records->map(function($rec) {

                $student_activity = StudentActivityRecord::create($rec);

                $answers = collect($rec['answers'])->map(function($ans) use ($student_activity){
                    $ans['record_id'] = $student_activity->id;
                    unset($ans['is_correct']);

                    return $ans;
                });
                $student_activity_answers = StudentActivityAnswer::insert($answers->toArray());

                return $student_activity;
            });
            
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public function setActivityAnswers($request)
    {
        $this->activity = StudentActivity::find($request->activity_id);
        $this->records = collect($request->questionnaires)->map(function ($q) use ($request) {

            $activity_record = [
                'activity_id' => $request->activity_id,
                'user_id' => $this->user->getKey(),
                'questionnaire_id' => $q['questionnaire_id'],
                'school_id' => $this->user->school_id,
                'subject_id' => $request->subject_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'perfect_score' => $this->getQuestionnaireTotalScore($q['questionnaire_id']),
                'score' => $this->getStudentScore($q['answers']),
                'answers' => $q['answers']
            ];

            return $activity_record;
        });
    }

    public function getQuestionnaireTotalScore(int $id)
    {
        $this->question_weights = [];
        $questionnaire = Questionnaire::find($id);
        $score = 0;
        $questionnaire->questions->map(function ($q) use (&$score) {
            $score += $q->pivot->weight;
            $this->question_weights[$q->id] = $q->pivot->weight;
        });

        return $score;
    }

    public function getStudentScore($answers)
    {
        $score = 0;
        collect($answers)->map(function($ans) use (&$score) {
            if($ans['is_correct']) {
                $score += $this->question_weights[$ans['question_id']];
            }
        });

        return $score;
    }

    public function getRecords()
    {
        return $this->records;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function getOverAllPerfectScore()
    {
        return $this->records->sum('perfect_score');
    }

    public function getOverAllStudentScore()
    {
        return $this->records->sum('score');
    }

    public function getDuration()
    {
        //get one record, everything will have the same start/end time
        $record = $this->records->first();
        return strtotime($record->end_time) - strtotime($record->start_time); 
    }
}