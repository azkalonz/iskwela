<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\StudentActivityScore;
use \App\Models\Assignment;
use \App\Transformers\StudentActivityScoreTransformer;


class StudentActivityScoreController extends Controller
{

    const SEATWORK = 1;
	const PROJECT = 2;

    public function setSeatworkScore(Request $request)
    {
        return $this->setScore($request, self::SEATWORK);
    }

    public function showSeatworkScore(Request $request)
    {
        return $this->show($request, self::SEATWORK);
    }

    public function setProjectScore(Request $request)
    {
        return $this->setScore($request, self::PROJECT);
    }

    public function showProjectScore(Request $request)
    {
        return $this->show($request, self::PROJECT);
    }

    /**
     * Seatworks
     *
     * @api {post} <HOST>/api/class/seatwork/set-score Set Seatwork Score
     * @apiVersion 1.0.0
     * @apiName SetSeatworkScore
     * @apiDescription Sets a student seatwork score
     * @apiGroup Seatworks
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} score score of the student
     * @apiParam {Number} student_id user ID of the student
     * @apiParam {Number} activity_id activity ID
     *
     * @apiSuccess {Number} id the user's ID
     * @apiSuccess {DateTime} published_at
     * @apiSuccess {String} title
     * @apiSuccess {Number} perfect_score the expected total score of the project
     * @apiSuccess {Number} student_score the score achieved by the student
     * @apiSuccess {Number} rating the percentage rate
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		{
            "id": 2,
            "student_id": "2",
            "activity_id": "4",
            "score": "80",
            "score_percentage": 0.8
        }
     * 
     */
    public function setScore(Request $request, $activity_type)
    {

        $this->validate($request, [
            'score' => 'integer|required',
            'student_id' => 'integer|required',
            'activity_id' => 'integer|required'
        ]);

        $user =  Auth::user();

        $activity = Assignment::whereId($request->activity_id)->where('activity_type', '=', $activity_type)->firstOrFail();

        $activity_score = StudentActivityScore::firstOrNew(['activity_id' => $request->activity_id,
                                                            'student_id' => $request->student_id]);

        $activity_score->score = $request->score;
        $activity_score->score_percentage = ($request->score / $activity->total_score);
        
        if(!$activity_score->id)
        {
            $activity_score->created_by = $user->id;
        }
        
        $activity_score->updated_by = $user->id;    
        $activity_score->save();

        $fractal = fractal()->item($activity_score, new StudentActivityScoreTransformer);

        return response()->json($fractal->toArray());

    }

    public function show(Request $request, int $activity_type)
    {
        $this->validate($request, [
            'student_id' => 'integer'
        ]);
        
        $assignment = Assignment::whereId($request->id)->whereActivityType($activity_type)->firstOrFail();
        $activity_score = StudentActivityScore::whereActivityId($request->id);
        if($request->student_id)
        {
            $activity_score = $activity_score->whereStudentId($request->student_id);
        }

        $fractal = fractal()->collection($activity_score->get(), new StudentActivityScoreTransformer);

        return response()->json($fractal->toArray());

    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}