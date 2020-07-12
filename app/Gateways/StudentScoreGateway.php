<?php

namespace App\Gateways;

use App\Models\User;
use App\TransferObjects\StudentScoreData;

class StudentScoreGateway
{
    protected $student_records;
    protected $score_reports;
    protected $class_id;

    public function __construct(int $class_id, string $from, string $to)
    {
        $this->score_reports = collect();
        $this->class_id = $class_id;
        $this->student_records = User::with([
                    'activityRecords' => function($query) use ($from, $to) {
                                            $query->whereBetween('start_time', [$from, $to]);
                                        }
                    ])->inClass($this->class_id)->get();
    }

    /**
     * classfies activities into quizze, periodical, assignment, etc
     */
    public function getActivityScores()
    {
        $this->score_reports = $this->student_records->map(function($rec) {
            
            $quizzes = collect();
            $periodicals = collect();
            $assignments = collect();
            $student_records = [];

            $rec->activityRecords->map(function($act) use (&$quizzes, &$periodicals, &$assignments, &$student_records) {
                $activity_type = $act->studentActivity->activity_type;
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
                }
            });

            $student_records['quizzes'] = ($quizzes->sum('score')) ? (ROUND($quizzes->sum('score')/$quizzes->sum('perfect_score'), 3)) : 0;
            $student_records['periodicals'] = ($periodicals->sum('score')) ? (ROUND($periodicals->sum('score')/$periodicals->sum('perfect_score'), 3)) : 0;
            $student_records['assignments'] = ($assignments->sum('score')) ? (ROUND($assignments->sum('score')/$assignments->sum('perfect_score'), 3)) : 0; 


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

        return $this->score_reports;
    }
}