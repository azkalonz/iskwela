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
    const ASSIGNMENT = 3;

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
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the seatwork ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function setSeatworkScore(Request $request)
    {
        return $this->setScore($request, self::SEATWORK);
    }

    /**
     * Assignment Free-Style
     *
     * @api {post} <HOST>/api/assignment/v2/set-score Set Assignment Score
     * @apiVersion 1.0.0
     * @apiName SetFreeStyleAssignmentScore
     * @apiDescription Sets a student assignment score
     * @apiGroup Assignments: Free-Style
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} score score of the student
     * @apiParam {Number} student_id user ID of the student
     * @apiParam {Number} activity_id activity ID
     *
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the assignment ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function setAssignmentScore(Request $request)
    {
        return $this->setScore($request, self::ASSIGNMENT);
    }

    /**
     * Seatworks
     *
     * @api {get} <HOST>/api/class/seatwork/get-score/:id Get Seatwork Score
     * @apiVersion 1.0.0
     * @apiName GetSeatworkScore
     * @apiDescription Shows the score of student(s) of the given seatwork ID
     * @apiGroup Seatworks
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} student_id the student ID. If not provided, displays scores of all students in the class
     *
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the seatwork ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function showSeatworkScore(Request $request)
    {
        return $this->show($request, self::SEATWORK);
    }

    /**
     * Assignment Free-Style
     *
     * @api {get} <HOST>/api/assignment/v2/get-score/:id Get Assignment Score
     * @apiVersion 1.0.0
     * @apiName GetFreeStyleAssignmentScore
     * @apiDescription Shows the score of student(s) of the given assignment ID
     * @apiGroup Assignments: Free-Style
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} student_id the student ID. If not provided, displays scores of all students in the class
     *
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the assignment ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function showAssignmentScore(Request $request)
    {
        return $this->show($request, self::ASSIGNMENT);
    }

    /**
     * Projects
     *
     * @api {post} <HOST>/api/class/project/set-score Set Project Score
     * @apiVersion 1.0.0
     * @apiName SetProjectScore
     * @apiDescription Sets a student project score
     * @apiGroup Projects
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} score score of the student
     * @apiParam {Number} student_id user ID of the student
     * @apiParam {Number} activity_id activity ID
     *
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the project ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function setProjectScore(Request $request)
    {
        return $this->setScore($request, self::PROJECT);
    }

    /**
     * Projects
     *
     * @api {get} <HOST>/api/class/project/get-score/:id Get Project Score
     * @apiVersion 1.0.0
     * @apiName GetProjectScore
     * @apiDescription Shows the score of student(s) of the given project ID
     * @apiGroup Projects
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} student_id the student ID. If not provided, displays scores of all students in the class
     *
     * @apiSuccess {Number} id score record ID
     * @apiSuccess {Number} student_id
     * @apiSuccess {Number} activity_id the project ID
     * @apiSuccess {Number} score achieved points
     * @apiSuccess {Double} score_percentage score rating
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
    public function showProjectScore(Request $request)
    {
        return $this->show($request, self::PROJECT);
    }

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