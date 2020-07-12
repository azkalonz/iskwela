<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\StudentActivityGatewayTransformer;

use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Gateways\StudentActivityGateway;
use App\Models\StudentActivity;

class StudentActivityAnswerController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;

	/**
     * Submit QuizAnswer
     *
     * @api {post} <HOST>/api/quiz/answer/submit Submit Quiz
     * @apiVersion 1.0.0
     * @apiName SubmitQuiz
     * @apiDescription Allows submission of quiz answer
     * @apiGroup Submit Activity Answer
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
     * @api {post} <HOST>/api/periodical/answer/submit Submit Periodical
     * @apiVersion 1.0.0
     * @apiName SubmitPeriodical
     * @apiDescription Allows submission of periodical answer
     * @apiGroup Submit Activity Answer
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
     * @api {post} <HOST>/api/assignment/answer/submit Submit Assignment
     * @apiVersion 1.0.0
     * @apiName SubmitAssignment
     * @apiDescription Allows submission of assignment answer
     * @apiGroup Submit Activity Answer
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

}
