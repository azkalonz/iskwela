<?php

namespace App\Gateways;

use App\Models\User;
use App\Models\Classes;
use App\Models\Assignment;

use App\Models\ClassActivity;
use App\TransferObjects\StudentScoreData;
use App\TransferObjects\ActivityScoreData;

class StudentScoreGateway
{
    protected $class_id;
    protected $from;
    protected $to;

    public function __construct(int $class_id, string $from, string $to)
    {
        $this->score_reports = collect();
        $this->class_id = $class_id;
        $this->from = $from;
        $this->to = $to;

    }

    /**
     * calculate scores all of activities: quizzes, assigments, projects, seatwork, periodical
     */
    public function getActivityScores()
    {
        $student_records = User::with([
                        'scoreReport' => function($query) {
                            $query->whereBetween('date_created',  [$this->from, $this->to])
                                  ->whereClassId($this->class_id);
                        }
                    ])->inClass($this->class_id)->get();

        $score_reports = $student_records->map(function($rec) {

            $quizzes = collect();
            $periodicals = collect();
            $assignments = collect();
            $seatworks = collect();
            $projects = collect();
            $student_records = [];

            $rec->scoreReport->map(function($act) use (&$quizzes, &$periodicals, &$assignments, &$seatworks, &$projects, &$student_records) {
                $activity_type = $act->activity_type;

                switch($activity_type) {
                    case 1:
                        $quizzes->push($act);
                        break;
                    case 2:
                        $periodicals->push($act);
                        break;
                    case 3:
                        $assignments->push($act);
                        break;
                    case 4:
                        $seatworks->push($act);
                        break;
                    case 5:
                        $projects->push($act);
                        break;
                }
            });

            $student_records['quizzes'] = ($quizzes->sum('achieved_score')) ? (ROUND($quizzes->sum('achieved_score')/$quizzes->sum('perfect_score'), 3)) : 0;
            $student_records['periodicals'] = ($periodicals->sum('achieved_score')) ? (ROUND($periodicals->sum('achieved_score')/$periodicals->sum('perfect_score'), 3)) : 0;
            $student_records['assignments'] = ($assignments->sum('achieved_score')) ? (ROUND($assignments->sum('achieved_score')/$assignments->sum('perfect_score'), 3)) : 0; 
            $student_records['seatworks'] = ($seatworks->sum('achieved_score')) ? (ROUND($seatworks->sum('achieved_score')/$seatworks->sum('perfect_score'), 3)) : 0; 
            $student_records['projects'] = ($projects->sum('achieved_score')) ? (ROUND($projects->sum('achieved_score')/$projects->sum('perfect_score'), 3)) : 0; 

            $rec->activityRecords = collect($student_records);

            return StudentScoreData::create(
                    [
                        'id' => $rec->id,
                        'username' => $rec->username,
                        'first_name' => $rec->first_name,
                        'last_name' => $rec->last_name,
                        'scores' => $student_records
                    ]
                );
        });

        return $score_reports;
    }
   
    /**
     * returns the individual scores of the activity: assignment, periodical, quizzes
     */
    public function getScores(int $user_id, int $activity_type)
    {
        $activity = ClassActivity::selectRaw(
                'student_activities.id,
                class_activities.published_at,
                student_activities.title,
                student_activities.perfect_score,
                sum(student_activity_records.score) as total_score,
                sum(student_activity_records.score )/student_activities.perfect_score as rating'
            )
            ->type($activity_type, $this->class_id, $user_id)
            ->whereBetween('class_activities.published_at', [$this->from, $this->to])
            ->groupBy(['student_activities.id','student_activities.title','student_activities.perfect_score','class_activities.student_activity_id', 'class_activities.published_at', 'student_activity_records.batch'])
            ->get();

        $activity = $activity->map(function($act) {
            return ActivityScoreData::create($act->toArray());
        });

        return $activity;
    }

    /**
     * return scores for projects and seatworks
     */
    public function getClassActivityScores(int $user_id, int $activity_type)
    {
        $activity = Assignment::selectRaw(
            'assignments.id,
            assignments.due_date as published_at,
            assignments.title,
            assignments.total_score as perfect_score,
            sum(student_activity_scores.score) as total_score,
            sum(student_activity_scores.score )/assignments.total_score as rating'
        )
        ->score($activity_type, $this->class_id, $user_id)
        ->whereBetween('assignments.due_date', [$this->from, $this->to])
        ->wherePublished(1)
        ->groupBy([
            'assignments.id',
            'assignments.due_date',
            'assignments.title',
            'assignments.total_score',
        ])
        ->get();

        $activity = $activity->map(function($act) {
            return ActivityScoreData::create($act->toArray());
        });

        return $activity;
    }


}