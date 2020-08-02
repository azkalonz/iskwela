<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Gateways\StudentScoreGateway;
use App\Transformers\StudentScoreGatewayTransformer;
use App\Transformers\ActivityScoreDataTransformer;

use App\Models\Schedule;

class ReportController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;

	/**
     * Reports
     *
     * @api {get} <HOST>/api/reports/activity-scores Activity Scores
     * @apiVersion 1.0.0
     * @apiName ActivityScores
     * @apiDescription Get the activity scores per activity type
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Date=YYYY-mm-dd} [from] date filter; default value = class start_date
     * @apiParam {Date=YYYY-mm-dd} [to] date filter; default value = class end_date
     *
     * @apiSuccess {Number} id the user's ID
     * @apiSuccess {String} username
     * @apiSuccess {String} first_name
     * @apiSuccess {String} last_name
     * @apiSuccess {Array} scores the activity scores
     * @apiSuccess {Double} scores.quizzes score percentage based on the date range
     * @apiSuccess {Double} scores.periodicals score percentage based on the date range
     * @apiSuccess {Double} scores.assignments score percentage based on the date range
     * @apiSuccess {Double} scores.projects score percentage based on the date range
     * @apiSuccess {Double} scores.seatworks score percentage based on the date range
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 1,
				"username": "jayson",
				"first_name": "jayson",
				"last_name": "barino",
				"scores": {
					"quizzes": 0.583,
					"periodicals": 1,
					"assignments": 0.583
					"project": 0
					"seatwork": 0
				}
			},
			{},
			{},
			{}
		]
     * 
     */
	public function activities(Request $request)
	{
		$this->validate($request, [
			'class_id' => 'required|integer',
			'from' => 'string',
			'to' => 'string'
		]);

		if(!$request->from || !$request->to) {
			$schedule = Schedule::selectRaw("MIN(date_from) AS start, MAX(date_to) AS end")
					->whereClassId($request->class_id)->first();
			$request->from = $schedule->start;
			$request->to = $schedule->end;
		} 

		$sg = new StudentScoreGateway($request->class_id, $request->from, $request->to);
		$student_scores = $sg->getActivityScores();

		$fractal = fractal()->collection($student_scores, new StudentScoreGatewayTransformer);

        return response()->json($fractal->toArray());
	}

	/**
     * Reports
     *
     * @api {get} <HOST>/api/reports/quizzes Quiz Scores
     * @apiVersion 1.0.0
     * @apiName QuizScores
     * @apiDescription Returns scores of individual quizzes
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Number} user_id the user ID
     * @apiParam {Date=YYYY-mm-dd} [from] date filter; default value = class start_date
     * @apiParam {Date=YYYY-mm-dd} [to] date filter; default value = class end_date
     *
     * @apiSuccess {Number} id the user's ID
     * @apiSuccess {DateTime} published_at
     * @apiSuccess {String} title
     * @apiSuccess {Number} perfect_score the expected total score of the quiz
     * @apiSuccess {Number} student_score the score achieved by the student
     * @apiSuccess {Number} rating the percentage rate
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 22,
				"published_at": "2020-07-12 18:02:35",
				"title": "quiz1 - written",
				"perfect_score": "12",
				"student_score": "7",
				"rating": 0.5833333333333334
			},
			{
				"id": 22,
				"published_at": "2020-07-12 18:02:35",
				"title": "quiz1 - written",
				"perfect_score": "12",
				"student_score": "7",
				"rating": 0.5833333333333334
			},
			{
				"id": 25,
				"published_at": "2020-07-31 15:31:30",
				"title": "quiz4 - written",
				"perfect_score": "12",
				"student_score": 0,
				"rating": 0
			}
		]
     * 
     */
	public function quizzes(Request $request)
	{
		return $this->getScores($request, self::QUIZ);
	}

	/**
     * Reports
     *
     * @api {get} <HOST>/api/reports/periodicals Periodical Scores
     * @apiVersion 1.0.0
     * @apiName PeriodicalScores
     * @apiDescription Returns scores of individual periodical exams
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Number} user_id the user ID
     * @apiParam {Date=YYYY-mm-dd} [from] date filter; default value = class start_date
     * @apiParam {Date=YYYY-mm-dd} [to] date filter; default value = class end_date
     *
     * @apiSuccess {Number} id the user's ID
     * @apiSuccess {DateTime} published_at
     * @apiSuccess {String} title
     * @apiSuccess {Number} perfect_score the expected total score of the periodical
     * @apiSuccess {Number} student_score the score achieved by the student
     * @apiSuccess {Number} rating the percentage rate
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 23,
				"published_at": "2020-07-12 18:03:33",
				"title": "periodical 1 - written",
				"perfect_score": "12",
				"student_score": 0,
				"rating": 0
			}
		]
     * 
     */
	public function periodicals(Request $request)
	{
		return $this->getScores($request, self::PERIODICAL);
	}


	/**
     * Reports
     *
     * @api {get} <HOST>/api/reports/assignments Assignment Scores
     * @apiVersion 1.0.0
     * @apiName AssignmentsScores
     * @apiDescription Returns scores of individual assignments
     * @apiGroup Reports
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Number} user_id the user ID
     * @apiParam {Date=YYYY-mm-dd} [from] date filter; default value = class start_date
     * @apiParam {Date=YYYY-mm-dd} [to] date filter; default value = class end_date
     *
     * @apiSuccess {Number} id the user's ID
     * @apiSuccess {DateTime} published_at
     * @apiSuccess {String} title
     * @apiSuccess {Number} perfect_score the expected total score of the assignment
     * @apiSuccess {Number} student_score the score achieved by the student
     * @apiSuccess {Number} rating the percentage rate
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 24,
				"published_at": "2020-07-12 18:04:05",
				"title": "assignment1 - written",
				"perfect_score": "12",
				"student_score": 0,
				"rating": 0
			}
		]
     * 
     */
	public function assignments(Request $request)
	{
		return $this->getScores($request, self::ASSIGNMENT);
	}

	private function getScores(Request $request, int $activity_type)
	{
		$this->validate($request, [
			'class_id' => 'integer|integer',
			'user_id' => 'integer|required',
			'from' => 'string',
			'to' => 'string'
		]);

		if(!$request->from || !$request->to) {
			$schedule = Schedule::selectRaw("MIN(date_from) AS start, MAX(date_to) AS end")
					->whereClassId($request->class_id)->first();
			$request->from = $schedule->start;
			$request->to = $schedule->end;
		} 
		$sg = new StudentScoreGateway($request->class_id, $request->from, $request->to);
		$student_scores = $sg->getScores($request->user_id, $activity_type);
		$fractal = fractal()->collection($student_scores, new ActivityScoreDataTransformer);

        return response()->json($fractal->toArray());
	}
}
