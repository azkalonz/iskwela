<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\AssignmentAnswer;
use \App\Models\Assignment;
use \App\Transformers\AssignmentAnswerTransformer;

class AssignmentAnswerController extends Controller
{
    const ASSIGNMENT = 3;
    const SEATWORK = 1;
    const PROJECT = 2;

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/teacher/seatwork-answers/:id View Answers (for teacher)
    * @apiVersion 1.0.0
    * @apiName ShowSeatworkAnswerTeacher
    * @apiDescription Show the student's answer of the given seatwork
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the seatwork ID
    * @apiParam {Number} [student_id] if supplied, returns the answer of the specific student only
    *
    * @apiSuccess {Number} id record ID of the answer
    * @apiSuccess {Number} assignment_id the seatwork ID
    * @apiSuccess {String} answer_media link to the uploaded answer 
    * @apiSuccess {Object} student student details who submitted the answer 
    * @apiSuccess {Number} student.id
    * @apiSuccess {String} student.first_name
    * @apiSuccess {String} student.last_name
    * 
    * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 3,
                "assignment_id": 6,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/3",
                "answer_text": "Answer Text Sample",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
    *
    * 
   */
   /**
    * Seatworks
    *
    * @api {POST} HOST/api/student/seatwork-answers/:id View Answers (for student)
    * @apiVersion 1.0.0
    * @apiName ShowSeatworkAnswerStudent
    * @apiDescription Show the current student's answer of the given seatwork
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the seatwork ID
    *
    * @apiSuccess {Number} id record ID of the answer
    * @apiSuccess {Number} assignment_id the seatwork ID
    * @apiSuccess {String} answer_media link to the uploaded answer 
    * @apiSuccess {Object} student student details who submitted the answer 
    * @apiSuccess {Number} student.id
    * @apiSuccess {String} student.first_name
    * @apiSuccess {String} student.last_name
    * 
    * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 3,
                "assignment_id": 6,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/3",
                "answer_text": "Answer Text Sample",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
    *
    * 
   */
    public function showSeatworkAnswer(Request $request)
    {
        return $this->show($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/view-answers/:id View Answers
    * @apiVersion 1.0.0
    * @apiName ShowFreeStyleAssignmentAnswer
    * @apiDescription Show the student's answer of the given assignment
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the assignment ID
    * @apiParam {Number} [student_id] if supplied, returns the answer of the specific student only
    *
    * @apiSuccess {Number} id record ID of the answer
    * @apiSuccess {Number} assignment_id the assignment ID
    * @apiSuccess {String} answer_media link to the uploaded answer 
    * @apiSuccess {Object} student student details who submitted the answer 
    * @apiSuccess {Number} student.id
    * @apiSuccess {String} student.first_name
    * @apiSuccess {String} student.last_name
    * 
    * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 3,
                "assignment_id": 6,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/3",
                "answer_text": "Answer Text Sample",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
    *
    * 
   */
    public function showAssigmentAnswer(Request $request)
    {
        return $this->show($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/teacher/project-answers/:id View Answers (for teacher)
    * @apiVersion 1.0.0
    * @apiName ShowProjectAnswerTeacher
    * @apiDescription Show the student's answer of the given project
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the project ID
    * @apiParam {Number} [student_id] if supplied, returns the answer of the specific student only
    *
    * @apiSuccess {Number} id record ID of the answer
    * @apiSuccess {Number} assignment_id the project ID
    * @apiSuccess {String} answer_media link to the uploaded answer 
    * @apiSuccess {Object} student student details who submitted the answer 
    * @apiSuccess {Number} student.id
    * @apiSuccess {String} student.first_name
    * @apiSuccess {String} student.last_name
    * 
    * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 3,
                "assignment_id": 6,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/3",
                "answer_text": "Answer Text Sample",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
    *
    * 
   */
   /**
    * Projects
    *
    * @api {POST} HOST/api/student/project-answers/:id View Answers (for student)
    * @apiVersion 1.0.0
    * @apiName ShowProjectAnswerStudent
    * @apiDescription Show the current student's answer of the given project
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the project ID
    *
    * @apiSuccess {Number} id record ID of the answer
    * @apiSuccess {Number} assignment_id the project ID
    * @apiSuccess {String} answer_media link to the uploaded answer 
    * @apiSuccess {Object} student student details who submitted the answer 
    * @apiSuccess {Number} student.id
    * @apiSuccess {String} student.first_name
    * @apiSuccess {String} student.last_name
    * 
    * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 3,
                "assignment_id": 6,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/3",
                "answer_text": "Answer Text Sample",
                "student": {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino"
                }
            }
        ]
    *
    * 
   */
    public function showProjectAnswer(Request $request)
    {
        return $this->show($request, self::PROJECT);
    }

    public function show(Request $request, int $activity_type)
    {

        $this->validate($request, [
            'student_id' => 'integer'
        ]);

        $user =  Auth::user();

        $activity = Assignment::whereId($request->id)->whereActivityType($activity_type)->firstOrFail();
        $activityAnswer = AssignmentAnswer::whereAssignmentId($request->id);
        if($user->user_type == 's')
        {
            $activityAnswer->whereStudentId($user->id);    
        }
        else{
            if($request->student_id){
                $activityAnswer->whereStudentId($request->student_id);
            }
        }
       $fractal = fractal()->collection($activityAnswer->get(), new AssignmentAnswerTransformer);

       return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
