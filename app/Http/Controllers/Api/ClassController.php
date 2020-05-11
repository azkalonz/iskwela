<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Transformers\ClassesTransformer;
use Auth;
use App\Models\User;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class ClassController extends Controller
{

    /**
     * Gets classes
     *
     * @api {get} HOST/api/classes Get list of classes
     * @apiVersion 1.0.0
     * @apiName ClassList
     * @apiDescription Retrieves a list of classes
     * @apiGroup Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {StringOrNumber} user_id ID of user. If user is logged in, use `user_id=me`
     * @apiParam {String=schedules,students} include Comma separated relations to include. By default, lists don't include relations
     *
     * @apiSuccess {Number} id Unique class id
     * @apiSuccess {String} name Defined class name
     * @apiSuccess {String} description Class description
     * @apiSuccess {String} frequency The frequency of session
     * @apiSuccess {Date} date_from Start of class
     * @apiSuccess {Date} date_to End of class
     * @apiSuccess {Time} time_from Class duration
     * @apiSuccess {Time} time_to Class duration
     * @apiSuccess {Object} teacher The teacher handling the class
     * @apiSuccess {Number} teacher.id Unique teacher id
     * @apiSuccess {String} teacher.name The teacher's name
     * @apiSuccess {Array} schedules The class schedules
     * @apiSuccess {Number} schedules.id Unique schedule id
     * @apiSuccess {Number} schedules.date Session date
     * @apiSuccess {Number} schedules.status Session status: done, canceled
     * @apiSuccess {Array} schedules.materials Class resources: notes, lessons, etc
     * @apiSuccess {Number} schedules.materials.id Unique material id
     * @apiSuccess {String} schedules.materials.title
     * @apiSuccess {String} schedules.materials.instruction
     * @apiSuccess {String} schedules.materials.description
     * @apiSuccess {String} schedules.materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} schedules.materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Object} schedules.materials.added_by Someone who added the material
     * @apiSuccess {Number} schedules.materials.added_by.id ID of uploader
     * @apiSuccess {String} schedules.materials.added_by.name Name of uploader
     * @apiSuccess {Array} students List of students enrolled in the class
     * @apiSuccess {Number} students.id ID of student
     * @apiSuccess {Number} students.name Name of student
     * @apiSuccess {Number} students.user_type 's' => student by  default
     * 
     * 
     * @apiErrorExample user_id
     *     HTTP/1.1 422 user_id is not passed
     *     {
     *         "message": "The given data was invalid.",
     *         "errors": {
     *             "user_id": [
     *                 "The user id field is required."
     *             ]
     *         }
     * 
     * 
     * @apiSuccessExample {json} Sample Response
     [
         {
            "id": 1,
            "name": "English 101",
            "description": "learn basics",
            "frequency": "M,W,F",
            "date_from": "2020-05-11",
            "date_to": "2020-05-15",
            "time_from": "09:00:00",
            "time_to": "10:00:00",
            "teacher": {
                "id": 8,
                "name": "teacher tom"
            },
            "schedules": [
                {
                    "id": 1,
                    "date": "2020-05-11",
                    "status": 0,
                    "materials": [
                        {
                            "id": 1,
                            "title": "English Writing Part 1",
                            "instruction": "read the textbook",
                            "description": "learn english writing",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-writing-part1",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        },
                        {
                            "id": 2,
                            "title": "English Writing Part 1",
                            "instruction": "read the textbook",
                            "description": "learn english writing",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-writing-part2",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        }
                    ]
                },
                {
                    "id": 2,
                    "date": "2020-05-13",
                    "status": 0,
                    "materials": [
                        {
                            "id": 3,
                            "title": "English Speaking",
                            "instruction": "read the textbook",
                            "description": "learn english speaking",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-speaking",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        }
                    ]
                },
                {
                    "id": 3,
                    "date": "2020-05-15",
                    "status": 0,
                    "materials": [
                        {
                            "id": 4,
                            "title": "English Grammar",
                            "instruction": "read the textbook",
                            "description": "learn english grammar",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-grammar",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        }
                    ]
                }
            ],
            "students": [
                {
                    "id": 1,
                    "name": "jayson",
                    "user_type": "s"
                },
                {
                    "id": 2,
                    "name": "grace",
                    "user_type": "s"
                },
                {
                    "id": 3,
                    "name": "jen",
                    "user_type": "s"
                },
                {
                    "id": 4,
                    "name": "davy",
                    "user_type": "s"
                }
            ]
         },
         .
         .
         .
     ]
     *
     * 
     * 
     */
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */

    public function index(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $user =  Auth::user();
        if($request->user_id != 'me') {
            $user = User::find($request->user_id);
        }

        $class = Classes::whereTeacherId($user->id)->get();
        $fractal = fractal()->collection($class, new ClassesTransformer);

       return response()->json($fractal->toArray());
    }
}
