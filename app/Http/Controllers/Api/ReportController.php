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

use App\Models\Classes;

class ReportController extends Controller
{

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
     * @apiSuccess {Double} scores.assignements score percentage based on the date range
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
			$class = Classes::find($request->class_id);

			$request->from = $class->date_from;
			$request->to = $class->date_to;
		} 

		$sg = new StudentScoreGateway($request->class_id, $request->from, $request->to);
		$student_scores = $sg->getActivityScores();

		$fractal = fractal()->collection($student_scores, new StudentScoreGatewayTransformer);

        return response()->json($fractal->toArray());
	}
}
