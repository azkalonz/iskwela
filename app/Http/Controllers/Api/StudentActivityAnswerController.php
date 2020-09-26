<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\StudentActivityGatewayTransformer;
use App\Transformers\ScoreReportViewTransformer;
use App\Transformers\StudentActivityTransformer;

use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Gateways\StudentActivityGateway;
use App\Models\StudentActivity;
use App\Models\ScoreReportRecordView;

class StudentActivityAnswerController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;

	/**
     * Submit QuizAnswer
     *
     * @api {post} <HOST>/api/quiz/answer/submit Submit Quiz Questionnaire (answers)
     * @apiVersion 1.0.0
     * @apiName SubmitQuiz
     * @apiDescription Allows submission of quiz answer
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} activity_id the quiz ID
     * @apiParam {Number} subject_id the subject ID
     * @apiParam {DateTime} start_time the time when the student starts the quiz
     * @apiParam {DateTime} end_time the time when the student finishes the quiz
     * @apiParam {Array} questionnaires the array of questionnaires with answers
     * @apiParam {Number} questionnaires.questionnaire_id the ID of questionnaire
     * @apiParam {Array} questionnaires.answers answer details and remarks
     * @apiParam {Number} questionnaires.answers.question_id the question ID
     * @apiParam {Number} questionnaires.answers.status <i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i>
     * @apiParam {Boolean} questionnaires.answers.is_correct marks if the answer is wrong/correct
     * @apiParam {String} questionnaires.answers.answer the actual answer string
     *
     * @apiSuccess {Number} id the quiz ID
     * @apiSuccess {Number} score the actual score of student
     * @apiSuccess {Double} score_percentage the student's score percentage
     * @apiSuccess {Number} perfect the total score of the quiz
     * @apiSuccess {Number} duration student's time in answerting the quiz
     * @apiSuccess {Array} questionnaires details of students's answers
     * @apiSuccess {Number} questionnaires.id the questionnaire ID
     * @apiSuccess {Number} questionnaires.activity_record_id record ID of this attempt
     * @apiSuccess {Array} questionnaires.answers answer details and remarks
     * @apiSuccess {Number} questionnaires.answers.id record ID of this answer
     * @apiSuccess {Number} questionnaires.answers.question_id the question which this answer is for
     * @apiSuccess {Number} questionnaires.answers.status <i>PLACEHOLDER</i>
     * @apiSuccess {Number} questionnaires.answers.is_correct answer remark
     * @apiSuccess {String} questionnaires.answers.answer the actual answer string
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 22,
			"score": 7,
			"score_percent": 0.58,
			"pefect_score": 12,
			"duration": 1500,
			"questionnaires": [
				{
					"questionnaire_id": 2,
					"activity_record_id": 36,
					"answers": [
						{
							"id": 71,
							"question_id": 3,
							"status": 0,
							"is_correct": 1,
							"answer": "test 3"
						},
						{
							"id": 72,
							"question_id": 4,
							"status": 0,
							"is_correct": 1,
							"answer": "test 4"
						}
					]
				},
				{
					"questionnaire_id": 3,
					"activity_record_id": 37,
					"answers": [
						{
							"id": 73,
							"question_id": 5,
							"status": 0,
							"is_correct": 1,
							"answer": "test 5"
						},
						{
							"id": 74,
							"question_id": 6,
							"status": 0,
							"is_correct": 0,
							"answer": "test 6"
						}
					]
				}
			]
		}
     * 
     */
	public function submitQuizAnswer(Request $request)
	{
		return $this->submitAnswer($request, self::QUIZ, 'Quiz');
	}

	/**
     * Submit PeriodicalAnswer
     *
     * @api {post} <HOST>/api/periodical/answer/submit Submit Periodical Questionnaire (answers)
     * @apiVersion 1.0.0
     * @apiName SubmitPeriodical
     * @apiDescription Allows submission of periodical answer
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} activity_id the periodical ID
     * @apiParam {Number} subject_id the subject ID
     * @apiParam {DateTime} start_time the time when the student starts the periodical
     * @apiParam {DateTime} end_time the time when the student finishes the periodical
     * @apiParam {Array} questionnaires the array of questionnaires with answers
     * @apiParam {Number} questionnaires.questionnaire_id the ID of questionnaire
     * @apiParam {Array} questionnaires.answers answer details and remarks
     * @apiParam {Number} questionnaires.answers.question_id the question ID
     * @apiParam {Number} questionnaires.answers.status <i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i>
     * @apiParam {Boolean} questionnaires.answers.is_correct marks if the answer is wrong/correct
     * @apiParam {String} questionnaires.answers.answer the actual answer string
     *
     * @apiSuccess {Number} id the periodical ID
     * @apiSuccess {Number} score the actual score of student
     * @apiSuccess {Double} score_percentage the student's score percentage
     * @apiSuccess {Number} perfect the total score of the periodical
     * @apiSuccess {Number} duration student's time in answerting the periodical
     * @apiSuccess {Array} questionnaires details of students's answers
     * @apiSuccess {Number} questionnaires.id the questionnaire ID
     * @apiSuccess {Number} questionnaires.activity_record_id record ID of this attempt
     * @apiSuccess {Array} questionnaires.answers answer details and remarks
     * @apiSuccess {Number} questionnaires.answers.id record ID of this answer
     * @apiSuccess {Number} questionnaires.answers.question_id the question which this answer is for
     * @apiSuccess {Number} questionnaires.answers.status <i>PLACEHOLDER</i>
     * @apiSuccess {Number} questionnaires.answers.is_correct answer remark
     * @apiSuccess {String} questionnaires.answers.answer the actual answer string
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 23,
            "score": 6,
            "score_percentage": 1,
            "pefect_score": 6,
            "duration": 1500,
            "questionnaires": [
                {
                    "questionnaire_id": 4,
                    "activity_record_id": 38,
                    "answers": [
                        {
                            "id": 75,
                            "question_id": 7,
                            "status": 0,
                            "is_correct": 1,
                            "answer": "test 3"
                        },
                        {
                            "id": 76,
                            "question_id": 8,
                            "status": 0,
                            "is_correct": 1,
                            "answer": "test 4"
                        }
                    ]
                }
            ]
        }
     * 
     */
	public function submitPeriodicalAnswer(Request $request)
	{
		return $this->submitAnswer($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Submit AssignmentAnswer
     *
     * @api {post} <HOST>/api/assignment/answer/submit Submit Assignment Questionnaire (answers)
     * @apiVersion 1.0.0
     * @apiName SubmitAssignment
     * @apiDescription Allows submission of assignment answer
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} activity_id the assignment ID
     * @apiParam {Number} subject_id the subject ID
     * @apiParam {DateTime} start_time the time when the student starts the assignment
     * @apiParam {DateTime} end_time the time when the student finishes the assignment
     * @apiParam {Array} questionnaires the array of questionnaires with answers
     * @apiParam {Number} questionnaires.questionnaire_id the ID of questionnaire
     * @apiParam {Array} questionnaires.answers answer details and remarks
     * @apiParam {Number} questionnaires.answers.question_id the question ID
     * @apiParam {Number} questionnaires.answers.status <i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i>
     * @apiParam {Boolean} questionnaires.answers.is_correct marks if the answer is wrong/correct
     * @apiParam {String} questionnaires.answers.answer the actual answer string
     *
     * @apiSuccess {Number} id the assignment ID
     * @apiSuccess {Number} score the actual score of student
     * @apiSuccess {Double} score_percentage the student's score percentage
     * @apiSuccess {Number} perfect the total score of the assignment
     * @apiSuccess {Number} duration student's time in answerting the assignment
     * @apiSuccess {Array} questionnaires details of students's answers
     * @apiSuccess {Number} questionnaires.id the questionnaire ID
     * @apiSuccess {Number} questionnaires.activity_record_id record ID of this attempt
     * @apiSuccess {Array} questionnaires.answers answer details and remarks
     * @apiSuccess {Number} questionnaires.answers.id record ID of this answer
     * @apiSuccess {Number} questionnaires.answers.question_id the question which this answer is for
     * @apiSuccess {Number} questionnaires.answers.status <i>PLACEHOLDER</i>
     * @apiSuccess {Number} questionnaires.answers.is_correct answer remark
     * @apiSuccess {String} questionnaires.answers.answer the actual answer string
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 24,
            "score": 7,
            "score_percentage": 0.58,
            "pefect_score": 12,
            "duration": 1500,
            "questionnaires": [
                {
                    "questionnaire_id": 5,
                    "activity_record_id": 39,
                    "answers": [
                        {
                            "id": 77,
                            "question_id": 9,
                            "status": 0,
                            "is_correct": 1,
                            "answer": "test 3"
                        },
                        {
                            "id": 78,
                            "question_id": 10,
                            "status": 0,
                            "is_correct": 1,
                            "answer": "test 4"
                        }
                    ]
                },
                {
                    "questionnaire_id": 6,
                    "activity_record_id": 40,
                    "answers": [
                        {
                            "id": 79,
                            "question_id": 11,
                            "status": 0,
                            "is_correct": 1,
                            "answer": "test 5"
                        },
                        {
                            "id": 80,
                            "question_id": 12,
                            "status": 0,
                            "is_correct": 0,
                            "answer": "test 6"
                        }
                    ]
                }
            ]
        }
     * 
     */
	
	public function submitAssignmentAnswer(Request $request)
	{
		return $this->submitAnswer($request, self::ASSIGNMENT, 'Assignment');
	}

	public function submitAnswer(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$this->validate($request, [
			'activity_id' => 'required|integer',
			'subject_id' => 'required|integer',
			'start_time' => 'required|string',
			'end_time' => 'required|string',
			'questionnaires' => 'required|array',
			'questionnaires.*.questionnaire_id' => 'required|integer',
			'questionnaires.*.answers' => 'required|array'
		]);

		$activity = StudentActivity::whereId($request->activity_id)->whereActivityType($activity_type)->first();
		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		$sac_gw = new StudentActivityGateway();
		$sac_gw->setActivityAnswers($request);
		$sac_gw->save();

		$fractal = fractal()->item($sac_gw, new StudentActivityGatewayTransformer);

        return response()->json($fractal->toArray());
    }
    

	/**
     * Get Student scores of the given activity
     *
     * @api {post} <HOST>/api/activity/scores Get Students Scores of the activity
     * @apiVersion 1.0.0
     * @apiName studentActivityScores
     * @apiDescription Returns the scores of the students of the given activity ID
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} activity_id the activity ID
     *
     * @apiSuccess {Number} activity_id the activity ID
     * @apiSuccess {Number} student_id the student ID
     * @apiSuccess {String} first_name
     * @apiSuccess {String} last_name
     * @apiSuccess {Number} perfect_score the total score of the activity
     * @apiSuccess {Number} achieved_score the student's score
     * @apiSuccess {Double} achieved_score_percent student's score in percentage
     * @apiSuccess {Number} attempts number of submissions/takes from students
     * @apiSuccessExample {json} Sample Response
        [
            {
                "activity_id": 34,
                "student_id": 5,
                "first_name": "jacque",
                "last_name": "amaya",
                "perfect_score": 25,
                "achieved_score": 0,
                "achieved_score_percent": 0,
                "attempts": 0
            },
            {
                "activity_id": 34,
                "student_id": 4,
                "first_name": "davy",
                "last_name": "castillo",
                "perfect_score": 25,
                "achieved_score": 0,
                "achieved_score_percent": 0,
                "attempts": 0
            },
            {},
            {}
        ]
     * 
     */
    public function getStudentScores(Request $request)
    {
        $this->validate($request, [
			'activity_id' => 'required|integer'
		]);
        $scores = ScoreReportRecordView::whereActivityId($request->activity_id)->get();
        $fractal = fractal()->collection($scores, new ScoreReportViewTransformer);
        return response()->json($fractal->toArray());
    }


	/**
     * Get list of submissions of the activity
     *
     * @api {post} <HOST>/api/activity/attempts List of Activity Attempts
     * @apiVersion 1.0.0
     * @apiName StudentAttemptsList
     * @apiDescription Returns the list of submissions/attempts of the student of the given activity ID
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} activity_id the activity ID
     * @apiParam {Number} student_id the student ID
     *
     * @apiSuccess {Number} activity_id the activity ID
     * @apiSuccess {Number} student_id the student ID
     * @apiSuccess {String} attempt_id ID of submission/attempt
     * @apiSuccess {Number} perfect_score the total score of the activity
     * @apiSuccess {Number} achieved_score the student's score
     * @apiSuccess {Double} achieved_score_percent student's score in percentage
     * @apiSuccess {DateTime} taken_at the time of submission
     * @apiSuccessExample {json} Sample Response
        [
            {
                "activity_id": 34,
                "student_id": 1,
                "attempt_id": "16010883475f6eab5beda037.17196012",
                "achieved_score": "11",
                "perfect_score": "25",
                "achieved_score_percent": 0.44,
                "taken_at": "2020-09-26 10:45:48"
            },
            {
                "activity_id": 34,
                "student_id": 1,
                "attempt_id": "16010924155f6ebb3f99c1b1.79708317",
                "achieved_score": "15",
                "perfect_score": "25",
                "achieved_score_percent": 0.6,
                "taken_at": "2020-09-26 11:53:36"
            }
            {},
            {}
        ]
     * 
     */
    public function getAttempts(Request $request)
    {
        $this->validate($request, [
            'activity_id' => 'required|integer',
            'student_id' => 'required|integer'
        ]);

        $activity = StudentActivity::selectRaw(
                "
                student_activities.id as activity_id,
                student_activity_records.user_id as student_id,
                student_activity_records.batch as attempt_id,
                sum(student_activity_records.score) as achieved_score,
                student_activities.perfect_score,
                (sum(student_activity_records.score)/student_activities.perfect_score) as achieved_score_percent,
                max(student_activity_records.created_at) as taken_at
                "
            )
            ->where('student_activities.id', '=' ,$request->activity_id)
            ->studentRecords($request->student_id)
            ->groupBy([
                'student_activities.id',
                'student_activity_records.batch',
                'student_activities.perfect_score',
                'student_activity_records.user_id'
            ])
            ->get();

            return response()->json($activity->toArray());
    }

	/**
     * Get the attempt details
     *
     * @api {get} <HOST>/api/activity/attempt/show Get the student's answer details
     * @apiVersion 1.0.0
     * @apiName StudentAnswerDetails
     * @apiDescription Returns the student's answers
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String} attempt_id the ID of submission/attempt
     * @apiParam {Number} activity_id the activity_id
	 * 
     * @apiSuccess {Number} id the activity ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * @apiSuccess {Object} questionnaires.questions.student_answer the student's answer; Under the "question" object
     * @apiSuccess {Number} questionnaires.questions.student_answer.is_correct 1: student answered correctly, 2: student answered wrongly
     * @apiSuccess {String} questionnaires.questions.student_answer.answer the student's answer
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 17,
			"title": "quiz2 - written",
			"instruction": "answer this",
			"duration": 60,
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
							"question": "test",
							"question_type": "mcq",
							"media_url": "http://sample-media.com/q1-quiz1",
							"weight": 1,
							"choices": [
								{
									"option": "a",
									"is_correct": 1
								},
								{
									"option": "b",
									"is_correct": 0
								},
								{
									"option": "c",
									"is_correct": 0
								},
								{
									"option": "d",
									"is_correct": 0
								},
								{
									"option": "e",
									"is_correct": 0
								}
							],
                            "student_answer": {
                                "is_correct": 1,
                                "answer": "test 3"
                            }
						},
						{
							"id": 4,
							"question": "test2",
							"question_type": "mcq",
							"media_url": "http://sample-media.com/q2-quiz1",
							"weight": 5,
							"choices": [
								{
									"option": "a",
									"is_correct": 0
								},
								{
									"option": "b",
									"is_correct": 1
								},
								{
									"option": "c",
									"is_correct": 1
								}
							],
                            "student_answer": {
                                "is_correct": 1,
                                "answer": "test 4"
                            }
						}
					]
				}
			]
		}
     * 
     * 
     */
    public function showAttempt(Request $request)
    {
        $this->validate($request, [
            'activity_id' => 'required|integer',
            'attempt_id' => 'required'
        ]);
        $a = StudentActivity::with([
            'questionnaires',
            'questionnaires.questions' => function($query) use ($request) {
                $query->selectRaw('
                questions.*,
                student_answers_v.is_correct,
                student_answers_v.answer as student_answer
            ');
                $query->leftJoin('student_answers_v', function($join) use ($request) {
                    $join->on('student_answers_v.question_id', '=', 'questions.id')
                    ->where('student_answers_v.batch', '=', $request->attempt_id);
                });
            }   
        ])->whereId($request->activity_id)
        ->first();

        $fractal = fractal()->item($a, new StudentActivityTransformer);
        $fractal->includeQuestionnaires();

        $not_needed = [
            'activity_availability_status',
            'subject',
            'published',
            'submission_status',
            'submission_date',
            'category'
        ];

        return response()->json($this->unsetFields($not_needed, $fractal->toArray()));
    }

    private function unsetFields(Array $fields, Array $arr)
    {
        foreach($fields as $f) {
            unset($arr[$f]);
        }

        return $arr;
    }

}
