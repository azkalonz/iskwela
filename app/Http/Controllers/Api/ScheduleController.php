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
     * @apiParam {Date} from New start date/time (YYYY-mm-dd H:i:s)
     * @apiParam {Date} to New end date/time  (YYYY-mm-dd H:i:s)
     * @apiParam {Number=PENDING,DONE,ONGOING,CANCELED} status
     *
     * @apiUse ScheduleObject
     * @apiUse ScheduleSampleResponse
     *
    */
    public function save(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'date_from' => 'string',
            'date_to' => 'string',
            'teacher_id' => 'integer',
            'status' => 'string|in:PENDING,DONE,ONGOING,CANCELED'
        ]);


        $user =  Auth::user();

        $schedule = Schedule::find($request->id);
        $schedule->date_from = $request->date_from ?? $request->date_from;
        $schedule->date_to = $request->date_to ?? $schedule->date_to;
        $schedule->teacher_id = $request->teacher_id ?? $schedule->teacher_id;

        $status = $request->status ?? $schedule->status;
        $schedule->status = array_search($status, config('school_hub.schedule_status'));
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
     * Class Schedules
     *
     * @api <HOST>/api/teacher/class-schedules/{id} Get class schedules
     * @apiVersion 1.0.0
     * @apiName ClassSchedules
     * @apiDescription Returns array of class schedules
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     * @apiParam {String=materials,activities,lessonPlans} include comma separated; available relations to include
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} materials list of materials used in the session (or empty)
     * @apiSuccess {Number} materials.id the activity ID
     * @apiSuccess {String} materials.title
     * @apiSuccess {String} materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} materials.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Object} materials.added_by the teacher/user who added this material
     * @apiSuccess {Number} materials.added_by.id
     * @apiSuccess {String} materials.added_by.first_name
     * @apiSuccess {String} materials.added_by.last_name
     * @apiSuccess {Array} activities the activitiy list of the session (or empty)
     * @apiSuccess {Number} activities.id the activity ID
     * @apiSuccess {String} activities.title
     * @apiSuccess {String} activities.desription
     * @apiSuccess {String} activities.activit_type "class activity" or "assignment"
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {String} activities.status "published" or "unpublished"
     * @apiSuccess {Array} activities.materials array of references/materials for this activity (or empty)
     * @apiSuccess {Number} activities.materials.id the material ID
     * @apiSuccess {String} activities.materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} activities.materials.resource_link a shared reference link (google docs, etc)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [
                    {
                        "id": 1,
                        "title": "English Writing Part 1",
                        "uploaded_file": "",
                        "resource_link": "https://sample-lesson-link.com/english-writing-part1",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    },
                    {}
                ],
                "activities": [
                    {
                        "id": 1,
                        "title": "English Assignment 1",
                        "description": "read it",
                        "activity_type": "class activity",
                        "available_from": "2020-05-11",
                        "available_to": "2020-05-15",
                        "status": "unpublished",
                        "materials": [
                            {
                                "id": 1,
                                "uploaded_file": "http://link-to-uploaded-file/sample",
                                "resource_link": ""
                            },
                            {
                                "id": 2,
                                "uploaded_file": "",
                                "resource_link": "http://read-english.com/basics2"
                            }
                        ]
                    },
                    {}
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [],
                "activities": []
            },
            {},
            {}
        ]
     * 
     */
    
    
    public function classTeacherSchedules(Request $request)
    {
        return $this->getClasSchedules($request->id);
    }

    private function getClasSchedules($class_id)
    {
        $schedules = Schedule::whereClassId($class_id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Class Activities
     *
     * @api <HOST>/api/teacher/class-activities/{id} Get class activities (by schedule)
     * @apiVersion 1.0.0
     * @apiName ClassActivities
     * @apiDescription Returns list of class activities classified by (array of)schedules
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} activities the activitiy list of the session (or empty)
     * @apiSuccess {Number} activities.id the activity ID
     * @apiSuccess {String} activities.title
     * @apiSuccess {String} activities.desription
     * @apiSuccess {String} activities.activit_type "class activity" or "assignment"
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {String} activities.status "published" or "unpublished"
     * @apiSuccess {Array} activities.materials array of references/materials for this activity (or empty)
     * @apiSuccess {Number} activities.materials.id the material ID
     * @apiSuccess {String} activities.materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} activities.materials.resource_link a shared reference link (google docs, etc)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "activities": [
                    {
                        "id": 1,
                        "title": "English Assignment 1",
                        "description": "read it",
                        "activity_type": "class activity",
                        "available_from": "2020-05-11",
                        "available_to": "2020-05-15",
                        "status": "unpublished",
                        "materials": [
                            {
                                "id": 1,
                                "uploaded_file": "",
                                "resource_link": "http://read-english.com/basics"
                            },
                            {
                                "id": 1,
                                "uploaded_file": "http://link-to-uploaded-file.com/sample",
                                "resource_link": ""
                            },
                    {}
                        ]
                    },
                    {}
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "activities": []
            }
        ]
     * 
     * 
     */
    
    public function activitiesBySchedule(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);
        //todo: add policy that only teacher/student related to class can view
        $schedules = Schedule::with('assignments')->whereClassId($request->id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);
        $fractal->includeActivities();

        return response()->json($fractal->toArray());
    }

    /**
     * Class Materials
     *
     * @api <HOST>/api/teacher/class-materials/{id} Get class materials (by schedule)
     * @apiVersion 1.0.0
     * @apiName ClassMaterials
     * @apiDescription Returns list of class materials classified by (array of)schedules
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} materials list of materials used in the session (or empty)
     * @apiSuccess {Number} materials.id the activity ID
     * @apiSuccess {String} materials.title
     * @apiSuccess {String} materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} materials.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Object} added_by the teacher/user who added this material
     * @apiSuccess {Number} added_by.id
     * @apiSuccess {String} added_by.first_name
     * @apiSuccess {String} added_by.last_name
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [
                    {
                        "id": 1,
                        "title": "English Writing Part 1",
                        "uploaded_file": "",
                        "resource_link": "https://sample-lesson-link.com/english-writing-part1",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    },
                    {
                        "id": 2,
                        "title": "English Writing Part 1",
                        "uploaded_file": "http://link-to-uploaded-file/sample",
                        "resource_link": "",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    }
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": []
            }
        ]
     * 
     */
    public function classMaterialsTeachersBySchedule(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);

        return $this->getClassMaterials($request->id);
       
    }

    /**
     * Class Materials
     *
     * @api <HOST>/api/teacher/class-materials/{id} Get class materials (by schedule)
     * @apiVersion 1.0.0
     * @apiName ClassMaterials
     * @apiDescription Returns list of class materials classified by (array of)schedules
     * @apiGroup Student Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} materials list of materials used in the session (or empty)
     * @apiSuccess {Number} materials.id the activity ID
     * @apiSuccess {String} materials.title
     * @apiSuccess {String} materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} materials.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Object} added_by the teacher/user who added this material
     * @apiSuccess {Number} added_by.id
     * @apiSuccess {String} added_by.first_name
     * @apiSuccess {String} added_by.last_name
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [
                    {
                        "id": 1,
                        "title": "English Writing Part 1",
                        "uploaded_file": "",
                        "resource_link": "https://sample-lesson-link.com/english-writing-part1",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    },
                    {
                        "id": 2,
                        "title": "English Writing Part 1",
                        "uploaded_file": "http://link-to-uploaded-file/sample",
                        "resource_link": "",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    }
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": []
            }
        ]
     * 
     */
    public function classMaterialsStudentsBySchedule(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);
        
        return $this->getClassMaterials($request->id);
    }

    private function getClassMaterials($class_id)
    {
        //todo: add policy that only teacher/student related to class can view
        $schedules = Schedule::with('materials')->whereClassId($class_id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);
        $fractal->includeMaterials();

        return response()->json($fractal->toArray());
    }

    /**
     * Class Lesson Plans
     *
     * @api <HOST>/api/teacher/class-lesson-plans/{id} Get class lesson plans (by schedule)
     * @apiVersion 1.0.0
     * @apiName ClassLessonPlans
     * @apiDescription Returns list of class lesson plans classified by (array of)schedules
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} lesson plan list of lesson plans used in the session (or empty)
     * @apiSuccess {Number} lessonPlans.id the Lesson Plan ID
     * @apiSuccess {String} lessonPlans.title
     * @apiSuccess {String} lessonPlans.uploaded_file link to uploaded file or
     * @apiSuccess {String} lessonPlans.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Object} added_by the teacher/user who added this lesson plan
     * @apiSuccess {Number} added_by.id
     * @apiSuccess {String} added_by.first_name
     * @apiSuccess {String} added_by.last_name
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
			{
				"id": 6,
				"from": "2020-05-22 09:00:00",
				"to": "2020-05-22 10:00:00",
				"teacher": {
					"id": 9,
					"first_name": "teacher jayson",
					"last_name": "barino"
				},
				"status": "",
				"lessonPlans": [
					{
						"id": 1,
						"title": "Hello Lesson Plan",
						"uploaded_file": "",
						"resource_link": "http://sample-lesson-plan-link.com",
						"added_by": {
							"id": 9,
							"first_name": "teacher jayson",
							"last_name": "barino"
						}
					}
				]
			},
			{
				"id": 7,
				"from": "2020-05-25 09:00:00",
				"to": "2020-05-25 10:00:00",
				"teacher": {
					"id": 9,
					"first_name": "teacher jayson",
					"last_name": "barino"
				},
				"status": "",
				"lessonPlans": []
			},
			{
				"id": 8,
				"from": "2020-05-26 09:00:00",
				"to": "2020-05-26 10:00:00",
				"teacher": {
					"id": 9,
					"first_name": "teacher jayson",
					"last_name": "barino"
				},
				"status": "",
				"lessonPlans": []
			},
			{
				"id": 9,
				"from": "2020-05-27 09:00:00",
				"to": "2020-05-27 10:00:00",
				"teacher": {
					"id": 9,
					"first_name": "teacher jayson",
					"last_name": "barino"
				},
				"status": "",
				"lessonPlans": []
			},
			{
				"id": 10,
				"from": "2020-05-28 09:00:00",
				"to": "2020-05-28 10:00:00",
				"teacher": {
					"id": 9,
					"first_name": "teacher jayson",
					"last_name": "barino"
				},
				"status": "",
				"lessonPlans": []
			}
		]
     * 
     */
    public function lessonPlansBySchedule(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);
		
        //todo: add policy that only teacher/student related to class can view
        
		$schedules = Schedule::with('lessonPlans')->whereClassId($request->id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);
        $fractal->includeLessonPlans();

        return response()->json($fractal->toArray());
    }

    /**
     * Class Schedules
     *
     * @api <HOST>/api/student/class-schedules/{id} Get class schedules
     * @apiVersion 1.0.0
     * @apiName ClassSchedules
     * @apiDescription Returns array of class schedules
     * @apiGroup Student Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     * @apiParam {String=materials,activities} include comma separated; available relations to include
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} materials list of materials used in the session (or empty)
     * @apiSuccess {Number} materials.id the activity ID
     * @apiSuccess {String} materials.title
     * @apiSuccess {String} materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} materials.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Object} materials.added_by the teacher/user who added this material
     * @apiSuccess {Number} materials.added_by.id
     * @apiSuccess {String} materials.added_by.first_name
     * @apiSuccess {String} materials.added_by.last_name
     * @apiSuccess {Array} activities the activitiy list of the session (or empty)
     * @apiSuccess {Number} activities.id the activity ID
     * @apiSuccess {String} activities.title
     * @apiSuccess {String} activities.desription
     * @apiSuccess {String} activities.activit_type "class activity" or "assignment"
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {String} activities.status "published" or "unpublished"
     * @apiSuccess {Array} activities.materials array of references/materials for this activity (or empty)
     * @apiSuccess {Number} activities.materials.id the material ID
     * @apiSuccess {String} activities.materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} activities.materials.resource_link a shared reference link (google docs, etc)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [
                    {
                        "id": 1,
                        "title": "English Writing Part 1",
                        "uploaded_file": "",
                        "resource_link": "https://sample-lesson-link.com/english-writing-part1",
                        "added_by": {
                            "id": 8,
                            "first_name": "teacher tom",
                            "last_name": "cruz"
                        }
                    },
                    {}
                ],
                "activities": [
                    {
                        "id": 1,
                        "title": "English Assignment 1",
                        "description": "read it",
                        "activity_type": "class activity",
                        "available_from": "2020-05-11",
                        "available_to": "2020-05-15",
                        "status": "unpublished",
                        "materials": [
                            {
                                "id": 1,
                                "uploaded_file": "http://link-to-uploaded-file/sample",
                                "resource_link": ""
                            },
                            {
                                "id": 2,
                                "uploaded_file": "",
                                "resource_link": "http://read-english.com/basics2"
                            }
                        ]
                    },
                    {}
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "materials": [],
                "activities": []
            },
            {},
            {}
        ]
     * 
     */
    
    
    public function classStudentSchedules(Request $request)
    {
        //todo:can include lesson and activity only
        return $this->getClasSchedules($request->id);
    }


    /**
     * Class Activities
     *
     * @api <HOST>/api/student/class-activities/{id} Get class activities (by schedule)
     * @apiVersion 1.0.0
     * @apiName ClassActivities
     * @apiDescription Returns list of class activities classified by (array of)schedules
     * @apiGroup Student Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Date} from date/time start of session
     * @apiSuccess {Date} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status
     * @apiSuccess {Array} activities the activitiy list of the session (or empty)
     * @apiSuccess {Number} activities.id the activity ID
     * @apiSuccess {String} activities.title
     * @apiSuccess {String} activities.desription
     * @apiSuccess {String} activities.activity_type "class activity" or "assignment"
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {String} activities.status "published"
     * @apiSuccess {Array} activities.materials array of references/materials for this activity (or empty)
     * @apiSuccess {Number} activities.materials.id the material ID
     * @apiSuccess {String} activities.materials.uploaded_file link to uploaded file or
     * @apiSuccess {String} activities.materials.resource_link a shared reference link (google docs, etc)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "publishedActivities": [
                    {
                        "id": 1,
                        "title": "English Assignment 1",
                        "description": "read it",
                        "activity_type": "class activity",
                        "available_from": "2020-05-11",
                        "available_to": "2020-05-15",
                        "status": "published",
                        "materials": [
                            {
                                "id": 1,
                                "uploaded_file": "",
                                "resource_link": "http://read-english.com/basics"
                            },
                            {
                                "id": 1,
                                "uploaded_file": "http://link-to-uploaded-file.com/sample",
                                "resource_link": ""
                            },
                    {}
                        ]
                    },
                    {}
                ]
            },
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                },
                "status": "",
                "activities": []
            }
        ]
     * 
     * 
     */
    
    public function studentActivitiesBySchedule(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);
        //todo: add policy that only teacher/student related to class can view
        $schedules = Schedule::where('class_id', $request->id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);
        $fractal->includePublishedActivities();

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
