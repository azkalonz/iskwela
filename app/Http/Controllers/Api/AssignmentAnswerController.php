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
     * @api {post} HOST/student/activity-answers/{id} Show Activity Answer
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
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "assignment_id": 1,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/1"
            },
            {
                "id": 2,
                "assignment_id": 1,
                "answer_media": "http://api.schoolhub.local:8080/api/download/activity/answer/2"
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

        $user =  Auth::user();

        $activity = AssignmentAnswer::whereAssignmentId($request->id)
            ->whereStudentId($user->id);

        $fractal = fractal()->collection($activity->get(), new AssignmentAnswerTransformer);

       return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
