<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Schedule;
use App\Transformers\ScheduleTransformer;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class ScheduleController extends Controller
{
    /**
     * @apiDefine ScheduleSampleResponse
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "from": "2020-05-15 01:00:00",
            "to": "2020-05-15 02:00:00",
            "teacher": {
                "id": 9,
                "first_name": "teacher jayson",
                "last_name": "barino"
            },
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
                        "name": null
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
                        "name": null
                    }
                }
            ],
            "activities": [
                {
                    "id": 1,
                    "title": "English Assignment 1",
                    "instruction": "read it",
                    "available_from": "2020-05-11",
                    "available_to": "2020-05-15",
                    "questions": [
                        {
                            "id": 1,
                            "question": "what is noun?"
                        },
                        {
                            "id": 2,
                            "question": "what is adverb"
                        },
                        {
                            "id": 3,
                            "question": "what is predicate?"
                        }
                    ],
                    "materials": [
                        {
                            "id": 1,
                            "uploaded_file": "",
                            "resource_link": "http://read-english.com/basics"
                        },
                        {
                            "id": 2,
                            "uploaded_file": "",
                            "resource_link": "http://read-english.com/basics2"
                        }
                    ]
                },
                {
                    "id": 2,
                    "title": "English Assignment 2",
                    "instruction": "read it",
                    "available_from": "2020-05-20",
                    "available_to": "2020-05-30",
                    "questions": [
                        {
                            "id": 4,
                            "question": "what is pronoun?"
                        },
                        {
                            "id": 5,
                            "question": "what is subject"
                        },
                        {
                            "id": 6,
                            "question": "what is plural?"
                        }
                    ],
                    "materials": [
                        {
                            "id": 3,
                            "uploaded_file": "",
                            "resource_link": "http://read-english.com/basics3"
                        }
                    ]
                }
            ]
        }
    
     */

    /**
     * @apiDefine ScheduleObject
     * @apiSuccess {Number} id Unique schedule id
     * @apiSuccess {Date} from Session start
     * @apiSuccess {Date} to Session end
     * @apiSuccess {Number} status Session status: done, canceled
     * @apiSuccess {Number} teacher teacher handling this session
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name Teacher name
     * @apiSuccess {String} teacher.last_name Teacher name
     * @apiSuccess {Array} materials Class resources: notes, lessons, etc
     * @apiSuccess {Number} materials.id Unique material id
     * @apiSuccess {String} materials.title
     * @apiSuccess {String} materials.instruction
     * @apiSuccess {String} materials.description
     * @apiSuccess {String} materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Object} materials.added_by Someone who added the material
     * @apiSuccess {Number} materials.added_by.id ID of uploader
     * @apiSuccess {String} materials.added_by.name Name of uploader
     * @apiSuccess {Array} activities List of activities attached to the session
     * @apiSuccess {Number} activities.id The activity id
     * @apiSuccess {String} activities.title 
     * @apiSuccess {String} activities.instruction 
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Array} activities.questions List of questions
     * @apiSuccess {Number} activities.questions.id The question id
     * @apiSuccess {String} activities.questions.question The question text
     * @apiSuccess {Array} activities.materials Array of reading materials needed for this activity
     * @apiSuccess {Number} activities.materials.id 
     * @apiSuccess {String} activities.materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} activities.materials.resource_link Link to materials e.g google doc, website,etc
     */

    /**
     * @api {post} HOST/api/schedule/save Schedule Edit
     * @apiVersion 1.0.0
     * @apiName ScheduleEdit
     * @apiDescription Allows editing schedule and returns the schdule object
     * @apiGroup Schedule
     * @apiSampleRequest off
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id The ID of schedule to be updated
     * @apiParam {Date} from New start date/time
     * @apiParam {Date} to New end date/timein
     * @apiParam {Number=0:not-started,1:ongoing,2:canceled} status 0 - not started, 1 - ongoing, 2 - cancelled
     *
     * @apiUse ScheduleObject
     * @apiUse ScheduleSampleResponse
     *
    */
    public function save(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'date_from' => 'integer',
            'date_to' => 'integer',
            'teacher_id' => 'integer'
        ]);

        $user =  Auth::user();

        $schedule = Schedule::find($request->id);
        $schedule->date_from = $request->date_from ?? $request->date_from;
        $schedule->date_to = $request->date_to ?? $schedule->date_to;
        $schedule->teacher_id = $request->teacher_id ?? $schedule->teacher_id;
        $schedule->status = $request->status ?? $schedule->status;
        $schedule->save();

        $fractal = fractal()->item($schedule, new ScheduleTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * @api {post} HOST/api/schedule/{id} Schedule Detail
     * @apiVersion 1.0.0
     * @apiName ScheduleDetail
     * @apiDescription Returns schedule detail of specified ID
     * @apiGroup Schedule
     * @apiSampleRequest off
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id The schedule ID
     * @apiUse ScheduleObject
     *
     * @apiUse ScheduleSampleResponse
   */
    public function show(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $user =  Auth::user();

        $schedule = Schedule::whereId($request->id)->first();
        $fractal = fractal()->item($schedule, new ScheduleTransformer);

        return response()->json($fractal->toArray());
    }


    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
