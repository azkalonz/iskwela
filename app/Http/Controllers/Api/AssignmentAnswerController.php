<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\AssignmentAnswer;
use \App\Transformers\AssignmentAnswerTransformer;

class AssignmentAnswerController extends Controller
{

    /**
     * Show Activity Answers
     *
     * @api {get} HOST/teacher/activity-answers/{id} Show Activity Answers
     * @apiVersion 1.0.0
     * @apiName ShowActivityAnswers
     * @apiDescription Get activity answers.
     * @apiGroup Teacher Classes
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
     * @api {get} HOST/student/activity-answers/{id} Show Activity Answer
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
    public function show(Request $request)
    {

        $this->validate($request, [
            'student_id' => 'integer'
        ]);

        $user =  Auth::user();

        $activity = AssignmentAnswer::whereAssignmentId($request->id);
        if($user->user_type == 's')
        {
            
            $activity->whereStudentId($user->id);    
        }
        else{
            if($request->student_id){
                $activity->whereStudentId($request->student_id);
            }
        }

       $fractal = fractal()->collection($activity->get(), new AssignmentAnswerTransformer);

       return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
