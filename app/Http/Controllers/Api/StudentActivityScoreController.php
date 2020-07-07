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
     * Set Activity Score
     *
     * @api {get} HOST/class/activity/set-score Set Activity Score
     * @apiVersion 1.0.0
     * @apiName SetActivityScore
     * @apiDescription Set activity score of a student.
     * @apiGroup Activities
     *
     * @apiParam {Number} id Activity ID
     * @apiParam {Number} student_id Student ID - if passed, will return all answers for this activity, otherwise, returns all answers of the specified student ID
     *
     * @apiSuccess {Number} id Activity Answer ID
     * @apiSuccess {String} assignment_id Activity ID
     * @apiSuccess {String} answer_media download link of the answer file
     * @apiSuccess {Object} student 
     * @apiSuccess {Number} student.id ID of Student 
     * @apiSuccess {Number} student.first_name First Name of Student 
     * @apiSuccess {Number} student.last_name Last Name of Student 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "assignment_id": 1,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/1",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            },
            {
                "id": 2,
                "assignment_id": 1,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/2",
                "student": {
                    "id": 2,
                    "first_name": "grace",
                    "last_name": "ungui"
                }
            }
        ]
     *
     * 
     * 
     */

    /**
     * Show Activity Answers
     *
     * @api {get} HOST/student/activity-answers/:id Show Activity Answer
     * @apiVersion 1.0.0
     * @apiName ShowActivityAnswer
     * @apiDescription Get student's activity answers.
     * @apiGroup Student Classes
     *
     * @apiParam {Number} id Activity ID
     *
     * @apiSuccess {Number} id Activity Answer ID
     * @apiSuccess {String} assignment_id Activity ID
     * @apiSuccess {String} answer_media download link of the answer file
     * @apiSuccess {Object} student 
     * @apiSuccess {Number} student.id ID of Student 
     * @apiSuccess {Number} student.first_name First Name of Student 
     * @apiSuccess {Number} student.last_name Last Name of Student 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "assignment_id": 1,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/1",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
     *
     * 
     * 
     */
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
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