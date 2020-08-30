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
    const ASSIGNMENT = 3;
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
                    "materials": [
                        {
                            "id": 1,
                            "title": "Sample Title",
                            "uploaded_file": "",
                            "resource_link": "http://read-english.com/basics"
                        },
                        {
                            "id": 2,
                            "title": "Sample Title",
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
                    "materials": [
                        {
                            "id": 3,
                            "title": "Sample Title",
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
     * @apiSuccess {String} materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Object} materials.added_by Someone who added the material
     * @apiSuccess {Number} materials.added_by.id ID of uploader
     * @apiSuccess {String} materials.added_by.name Name of uploader
     * @apiSuccess {Array} activities List of activities attached to the session
     * @apiSuccess {Number} activities.id The activity id
     * @apiSuccess {String} activities.title 
     * @apiSuccess {String} activities.description 
     * @apiSuccess {String} activities.activity_type 
     * @apiSuccess {Date} activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {String} activities.status published/unpublished
     * @apiSuccess {Array} activities.materials Array of reading materials needed for this activity
     * @apiSuccess {Number} activities.materials.id
     * @apiSuccess {String} activities.materials.title Title of the Activity Material
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
     * @apiParam {Number} teacher_id User ID of new assigned teacher
     * @apiParam {Number=PENDING,DONE,ONGOING,CANCELED} status
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {DateTime} from session start time
     * @apiSuccess {DateTime} to schedule end time
     * @apiSuccess {Object} teacher
     * @apiSuccess {Number} teacher.id the teacher ID
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String=PENDING,DONE,ONGOING,CANCELED} status schedule status
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "from": "2020-05-21 10:00:00",
            "to": "2020-05-21 11:00:00",
            "teacher": {
                "id": 9,
                "first_name": "teacher jayson",
                "last_name": "barino"
            },
            "status": "DONE"
        }
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
     * @api {post} HOST/api/schedule/:id Schedule Detail
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
        $user =  Auth::user();

        $schedule = Schedule::whereId($request->id)->first();
        $fractal = fractal()->item($schedule, new ScheduleTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Class Schedules
     *
     * @api <HOST>/api/teacher/class-schedules/:id Get class schedules
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
     * @apiSuccess {String} activities.materials.title Title of the Activity Material
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
                        "status": "published",
                        "materials": [
                            {
                                "id": 1,
                                "title": "Sample Title",
                                "uploaded_file": "http://link-to-uploaded-file/sample",
                                "resource_link": ""
                            },
                            {
                                "id": 2,
                                "title": "Sample Title",
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
     * @api <HOST>/api/teacher/class-materials/:id Get class materials (by schedule)
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
     * @apiSuccess {String} status status of the class material (published/unpublished)
     * @apiSuccess {Boolean} done returns true if the class material has been marked as done, otherwise, false.
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
     * @api <HOST>/api/teacher/class-materials/:id Get class materials (by schedule)
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
        $schedules = Schedule::whereClassId($class_id);

        $user = Auth::user();

        if($user->user_type == 's') {
            $schedules->with([
                'materials' => function($material) {
                    $material->where('published', 1);
                }
            ]);
        }
        else {
            $schedules->with('materials');
        }

        $fractal = fractal()->collection($schedules->get(), new ScheduleTransformer);
        $fractal->includeMaterials();

        return response()->json($fractal->toArray());
    }

    /**
     * Class Lesson Plans
     *
     * @api <HOST>/api/teacher/class-lesson-plans/:id Get class lesson plans (by schedule)
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
     * @apiSuccess {Boolean} lessonPlans.done returns true if lesson plan has been marked as done, otherwise, false
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
     * @api <HOST>/api/student/class-schedules/:id Get class schedules
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
     * @apiSuccess {String} activities.materials.title title of the Activity Material
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
                                "title": "Sample Title",
                                "uploaded_file": "http://link-to-uploaded-file/sample",
                                "resource_link": ""
                            },
                            {
                                "id": 2,
                                "title": NULL,
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
     * Seatworks
     *
     * @api {get} <HOST>/api/teacher/class-seatworks/:id List Class Seatworks by Schedule (for teacher)
     * @apiVersion 1.0.0
     * @apiName ClassSeatworksTeacher
     * @apiDescription Returns list of class seatworks classified by (array of)schedules
     * @apiGroup Seatworks
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Datetime} from date/time start of session
     * @apiSuccess {Datetime} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status the schedule status
     * @apiSuccess {Array} publishedSeatworks list of published seatworks for this schedule
     * @apiSuccess {Number} publishedSeatworks.id the seatwork ID
     * @apiSuccess {String} publishedSeatworks.title the seatwork title
     * @apiSuccess {String} publishedSeatworks.description
     * @apiSuccess {String=seatwork} publishedSeatworks.activity_type
     * @apiSuccess {Number} publishedSeatworks.grading_category the category ID
     * @apiSuccess {Number} publishedSeatworks.total_score the expected perfect score
     * @apiSuccess {DateTime} publishedSeatworks.due_date deadline for the seatwork to be taken
     * @apiSuccess {String=published} publishedSeatworks.status
     * @apiSuccess {Boolean} publishedSeatworks.done indicates whether the seatwork is open or closed. 
     * @apiSuccess {Array} publishedSeatworks.materials list of materials attached to this seatwork
     * @apiSuccess {Number} publishedSeatworks.materials.id the material ID
     * @apiSuccess {String} publishedSeatworks.materials.title
     * @apiSuccess {String} publishedSeatworks.materials.uploaded_file
     * @apiSuccess {String} publishedSeatworks.materials.resource_link
     * @apiSuccess {Array} unpublishedSeatworks list of published seatworks for this schedule
     * @apiSuccess {Number} unpublishedSeatworks.id the seatwork ID
     * @apiSuccess {String} unpublishedSeatworks.title the seatwork title
     * @apiSuccess {String} unpublishedSeatworks.description
     * @apiSuccess {String=seatwork} unpublishedSeatworks.activity_type
     * @apiSuccess {Number} unpublishedSeatworks.grading_category the category ID
     * @apiSuccess {Number} unpublishedSeatworks.total_score the expected perfect score
     * @apiSuccess {DateTime} unpublishedSeatworks.due_date deadline for the seatwork to be taken
     * @apiSuccess {String=unpublished} unpublishedSeatworks.status
     * @apiSuccess {Boolean} unpublishedSeatworks.done indicates whether the seatwork is open or closed. 
     * @apiSuccess {Array} unpublishedSeatworks.materials list of materials attached to this seatwork
     * @apiSuccess {Number} unpublishedSeatworks.materials.id the material ID
     * @apiSuccess {String} unpublishedSeatworks.materials.title
     * @apiSuccess {String} unpublishedSeatworks.materials.uploaded_file link to uploaded file
     * @apiSuccess {String} unpublishedSeatworks.materials.resource_link a shared reference link (google docs, etc)
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                },
                "status": "PENDING",
                "publishedSeatworks": [
                    {
                        "id": 6,
                        "title": "New Seatwork Test",
                        "description": "Seatwork description",
                        "activity_type": "seatwork",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "published",
                        "done": "false",
                        "materials": [
                            {
                                "id": 6,
                                "title": "Test Title 2",
                                "uploaded_file": "",
                                "resource_link": "sample-activity-material-link3.com"
                            }
                        ]
                    }
                ],
                "unpublishedSeatworks": [
                    {
                        "id": 3,
                        "title": "New assignment Test",
                        "description": "Seatwork description",
                        "activity_type": "seatwork",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    },
                    {
                        "id": 8,
                        "title": "New Seatwork Test",
                        "description": "Seatwork description",
                        "activity_type": "seatwork",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    }
                ]
            },
            {},
            {}
        ]
     * 
     * 
    */
    /**
     * Seatworks
     *
     * @api {get} <HOST>/api/student/class-seatworks/:id List Class Seatworks by Schedule (for student)
     * @apiVersion 1.0.0
     * @apiName ClassSeatworksStudent
     * @apiDescription Returns list of published class seatworks classified by (array of)schedules
     * @apiGroup Seatworks
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Datetime} from date/time start of session
     * @apiSuccess {Datetime} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status the schedule status
     * @apiSuccess {Array} publishedSeatworks list of published seatworks for this schedule
     * @apiSuccess {Number} publishedSeatworks.id the seatwork ID
     * @apiSuccess {String} publishedSeatworks.title the seatwork title
     * @apiSuccess {String} publishedSeatworks.description
     * @apiSuccess {String=seatwork} publishedSeatworks.activity_type
     * @apiSuccess {Number} publishedSeatworks.grading_category the category ID
     * @apiSuccess {Number} publishedSeatworks.total_score the expected perfect score
     * @apiSuccess {DateTime} publishedSeatworks.due_date deadline for the seatwork to be taken
     * @apiSuccess {String=published} publishedSeatworks.status
     * @apiSuccess {Boolean} publishedSeatworks.done indicates whether the seatwork is open or closed. 
     * @apiSuccess {Array} publishedSeatworks.materials list of materials attached to this seatwork
     * @apiSuccess {Number} publishedSeatworks.materials.id the material ID
     * @apiSuccess {String} publishedSeatworks.materials.title
     * @apiSuccess {String} publishedSeatworks.materials.uploaded_file
     * @apiSuccess {String} publishedSeatworks.materials.resource_link
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                },
                "status": "PENDING",
                "publishedSeatworks": [
                    {
                        "id": 6,
                        "title": "New Seatwork Test",
                        "description": "Seatwork description",
                        "activity_type": "seatwork",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "published",
                        "done": "false",
                        "materials": [
                            {
                                "id": 6,
                                "title": "Test Title 2",
                                "uploaded_file": "",
                                "resource_link": "sample-activity-material-link3.com"
                            }
                        ]
                    }
                ]
            },
            {},
            {}
        ]
     * 
     * 
    */
    public function studentSeatworksBySchedule(Request $request)
    {
        return $this->studentActivitiesBySchedule($request, 1);
    }


    /**
     * Assignment Free-Style
     *
     * @api {get} <HOST>/api/assignments/v2/:id List Class Assignments by Schedule
     * @apiVersion 1.0.0
     * @apiName ClassFreeStyleAssignment
     * @apiDescription Returns list of class assignments classified by (array of)schedules
     * @apiGroup Assignments: Free-Style
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Datetime} from date/time start of session
     * @apiSuccess {Datetime} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status the schedule status
     * @apiSuccess {Array} publishedAssignments list of published assignments for this schedule
     * @apiSuccess {Number} publishedAssignments.id the assignment ID
     * @apiSuccess {String} publishedAssignments.title the assignment title
     * @apiSuccess {String} publishedAssignments.description
     * @apiSuccess {String=assignment} publishedAssignments.activity_type
     * @apiSuccess {Number} publishedAssignments.grading_category the category ID
     * @apiSuccess {Number} publishedAssignments.total_score the expected perfect score
     * @apiSuccess {DateTime} publishedAssignments.due_date deadline for the assignment to be taken
     * @apiSuccess {String=published} publishedAssignments.status
     * @apiSuccess {Boolean} publishedAssignments.done indicates whether the assignment is open or closed. 
     * @apiSuccess {Array} publishedAssignments.materials list of materials attached to this assignment
     * @apiSuccess {Number} publishedAssignments.materials.id the material ID
     * @apiSuccess {String} publishedAssignments.materials.title
     * @apiSuccess {String} publishedAssignments.materials.uploaded_file
     * @apiSuccess {String} publishedAssignments.materials.resource_link
     * @apiSuccess {Array} unpublishedAssignments list of unpublished assignments for this schedule. Available to teachers only
     * @apiSuccess {Number} unpublishedAssignments.id the assignment ID
     * @apiSuccess {String} unpublishedAssignments.title the assignment title
     * @apiSuccess {String} unpublishedAssignments.description
     * @apiSuccess {String=assignment} unpublishedAssignments.activity_type
     * @apiSuccess {Number} unpublishedAssignments.grading_category the category ID
     * @apiSuccess {Number} unpublishedAssignments.total_score the expected perfect score
     * @apiSuccess {DateTime} unpublishedAssignments.due_date deadline for the assignment to be taken
     * @apiSuccess {String=unpublished} unpublishedAssignments.status
     * @apiSuccess {Boolean} unpublishedAssignments.done indicates whether the assignment is open or closed. 
     * @apiSuccess {Array} unpublishedAssignments.materials list of materials attached to this assignment
     * @apiSuccess {Number} unpublishedAssignments.materials.id the material ID
     * @apiSuccess {String} unpublishedAssignments.materials.title
     * @apiSuccess {String} unpublishedAssignments.materials.uploaded_file link to uploaded file
     * @apiSuccess {String} unpublishedAssignments.materials.resource_link a shared reference link (google docs, etc)
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                },
                "status": "PENDING",
                "publishedAssignments": [
                    {
                        "id": 6,
                        "title": "New Assignment Test",
                        "description": "Assignment description",
                        "activity_type": "assignment",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "published",
                        "done": "false",
                        "materials": [
                            {
                                "id": 6,
                                "title": "Test Title 2",
                                "uploaded_file": "",
                                "resource_link": "sample-activity-material-link3.com"
                            }
                        ]
                    }
                ],
                "unpublishedAssignments": [
                    {
                        "id": 3,
                        "title": "New assignment Test",
                        "description": "Assignments description",
                        "activity_type": "assignment",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    },
                    {
                        "id": 8,
                        "title": "New Assignment Test",
                        "description": "Assigment description",
                        "activity_type": "assignment",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    }
                ]
            },
            {},
            {}
        ]
     * 
     * 
    */
    public function assignmentsBySchedule(Request $request)
    {
        return $this->studentActivitiesBySchedule($request, self::ASSIGNMENT);
    }

    /**
     * Projects
     *
     * @api {get} <HOST>/api/teacher/class-projects/:id List Class Projects by Schedule (for teacher)
     * @apiVersion 1.0.0
     * @apiName ClassProjectsTeacher
     * @apiDescription Returns list of class projects classified by (array of)schedules
     * @apiGroup Projects
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Datetime} from date/time start of session
     * @apiSuccess {Datetime} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status the schedule status
     * @apiSuccess {Array} publishedProjects list of published projects for this schedule
     * @apiSuccess {Number} publishedProjects.id the project ID
     * @apiSuccess {String} publishedProjects.title the project title
     * @apiSuccess {String} publishedProjects.description
     * @apiSuccess {String=project} publishedProjects.activity_type
     * @apiSuccess {Number} publishedProjects.grading_category the category ID
     * @apiSuccess {Number} publishedProjects.total_score the expected perfect score
     * @apiSuccess {DateTime} publishedProjects.due_date deadline for the project to be taken
     * @apiSuccess {String=published} publishedProjects.status
     * @apiSuccess {Boolean} publishedProjects.done indicates whether the project is open or closed. 
     * @apiSuccess {Array} publishedProjects.materials list of materials attached to this project
     * @apiSuccess {Number} publishedProjects.materials.id the material ID
     * @apiSuccess {String} publishedProjects.materials.title
     * @apiSuccess {String} publishedProjects.materials.uploaded_file
     * @apiSuccess {String} publishedProjects.materials.resource_link
     * @apiSuccess {Array} unpublishedProjects list of published projects for this schedule
     * @apiSuccess {Number} unpublishedProjects.id the project ID
     * @apiSuccess {String} unpublishedProjects.title the project title
     * @apiSuccess {String} unpublishedProjects.description
     * @apiSuccess {String=project} unpublishedProjects.activity_type
     * @apiSuccess {Number} unpublishedProjects.grading_category the category ID
     * @apiSuccess {Number} unpublishedProjects.total_score the expected perfect score
     * @apiSuccess {DateTime} unpublishedProjects.due_date deadline for the project to be taken
     * @apiSuccess {String=unpublished} unpublishedProjects.status
     * @apiSuccess {Boolean} unpublishedProjects.done indicates whether the project is open or closed. 
     * @apiSuccess {Array} unpublishedProjects.materials list of materials attached to this project
     * @apiSuccess {Number} unpublishedProjects.materials.id the material ID
     * @apiSuccess {String} unpublishedProjects.materials.title
     * @apiSuccess {String} unpublishedProjects.materials.uploaded_file link to uploaded file
     * @apiSuccess {String} unpublishedProjects.materials.resource_link a shared reference link (google docs, etc)
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                },
                "status": "PENDING",
                "publishedProjects": [
                    {
                        "id": 6,
                        "title": "New Project Test",
                        "description": "Project description",
                        "activity_type": "project",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "published",
                        "done": "false",
                        "materials": [
                            {
                                "id": 6,
                                "title": "Test Title 2",
                                "uploaded_file": "",
                                "resource_link": "sample-activity-material-link3.com"
                            }
                        ]
                    }
                ],
                "unpublishedProjects": [
                    {
                        "id": 3,
                        "title": "New assignment Test",
                        "description": "Project description",
                        "activity_type": "project",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    },
                    {
                        "id": 8,
                        "title": "New Project Test",
                        "description": "Project description",
                        "activity_type": "project",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "unpublished",
                        "done": "false",
                        "materials": []
                    }
                ]
            },
            {},
            {}
        ]
     * 
     * 
    */
    /**
     * Projects
     *
     * @api {get} <HOST>/api/student/class-projects/:id List Class Projects by Schedule (for student)
     * @apiVersion 1.0.0
     * @apiName ClassProjectsStudent
     * @apiDescription Returns list of published class projects classified by (array of)schedules
     * @apiGroup Projects
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} id the schedule ID
     * @apiSuccess {Datetime} from date/time start of session
     * @apiSuccess {Datetime} to date/time end of session
     * @apiSuccess {Object} teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {String=PENDING,ONGOING,DONE,CANCELED} status the schedule status
     * @apiSuccess {Array} publishedProjects list of published projects for this schedule
     * @apiSuccess {Number} publishedProjects.id the project ID
     * @apiSuccess {String} publishedProjects.title the project title
     * @apiSuccess {String} publishedProjects.description
     * @apiSuccess {String=project} publishedProjects.activity_type
     * @apiSuccess {Number} publishedProjects.grading_category the category ID
     * @apiSuccess {Number} publishedProjects.total_score the expected perfect score
     * @apiSuccess {DateTime} publishedProjects.due_date deadline for the project to be taken
     * @apiSuccess {String=published} publishedProjects.status
     * @apiSuccess {Boolean} publishedProjects.done indicates whether the project is open or closed. 
     * @apiSuccess {Array} publishedProjects.materials list of materials attached to this project
     * @apiSuccess {Number} publishedProjects.materials.id the material ID
     * @apiSuccess {String} publishedProjects.materials.title
     * @apiSuccess {String} publishedProjects.materials.uploaded_file
     * @apiSuccess {String} publishedProjects.materials.resource_link
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 2,
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                },
                "status": "PENDING",
                "publishedProjects": [
                    {
                        "id": 6,
                        "title": "New Project Test",
                        "description": "Project description",
                        "activity_type": "project",
                        "grading_category": 1,
                        "total_score": 100,
                        "due_date": "2020-07-10 10:00:00",
                        "status": "published",
                        "done": "false",
                        "materials": [
                            {
                                "id": 6,
                                "title": "Test Title 2",
                                "uploaded_file": "",
                                "resource_link": "sample-activity-material-link3.com"
                            }
                        ]
                    }
                ]
            },
            {},
            {}
        ]
     * 
     * 
    */
    public function studentProjectsBySchedule(Request $request)
    {
        return $this->studentActivitiesBySchedule($request, 2);
    }
    
    public function studentActivitiesBySchedule(Request $request, int $activity_type)
    {
        $user = Auth::user();
        $this->validate($request, [
            'include' => 'in:""' //not customizable
        ]);
        //todo: add policy that only teacher/student related to class can view
        $schedules = Schedule::where('class_id', $request->id)->get();
        $fractal = fractal()->collection($schedules, new ScheduleTransformer);
        if($activity_type == 1)
        {
            $fractal->includePublishedSeatworks();
            if(in_array($user->user_type, ['t','a'])) {
                $fractal->includeUnpublishedSeatworks();
            }
        }
        else if($activity_type == 2)
        {
            $fractal->includePublishedProjects();
            if(in_array($user->user_type, ['t','a'])) {
                $fractal->includeUnpublishedProjects();
            }
        }
        else if($activity_type == self::ASSIGNMENT)
        {
            $fractal->includePublishedAssignments();
            if(in_array($user->user_type, ['t','a'])) {
                $fractal->includeUnpublishedAssignments();
            }
        }

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
