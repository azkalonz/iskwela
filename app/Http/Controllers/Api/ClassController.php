<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Transformers\ClassesTransformer;
use App\Transformers\ScheduleTransformer;
use App\Transformers\ScheduleAttendanceTransformer;
use App\Transformers\UserTransformer;
use Auth;
use App\Models\User;
use App\Models\Schedule;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class ClassController extends Controller
{

    /**
     * Teacher Class List
     *
     * @api {get} HOST/api/classes Teacher Class List
     * @apiVersion 1.0.0
     * @apiName TeacherClassList
     * @apiDescription Returns list of classes handled by teacher
     * @apiGroup Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {StringOrNumber} user_id retrieves list of classes of the specified user. If not passed, defaults to currently logged in user: "me"
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
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {Array} schedules The class schedules. NOT INCLUDED BY DEFAULT. REFER TO Class Details doc for the data.
     * @apiSuccess {Array} students List of students enrolled in the class. NOT INCLUDED BY DEFAULT. REFER TO Class Details doc for the data.
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
                "subject": {
                    "id": 1,
                    "name": "English"
                },
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                }
            },
            {
                "id": 2,
                "name": "Science 101",
                "description": "science experiments",
                "frequency": "T,TH",
                "date_from": "2020-05-11",
                "date_to": "2020-05-15",
                "time_from": "11:00:00",
                "time_to": "12:00:00",
                "subject": {
                    "id": 4,
                    "name": "Science"
                },
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz"
                }
            }
        ]
     *
     * 
     * 
     */

    public function index(Request $request)
    {
        //todo: add policy that only a school admin can view classes of other teachers
        // normal teacher can only view his/her own class or class being temporarily assigned
        if(!$request->user_id || $request->user_id == 'me') {
            $user_id = Auth::user()->getKey();
        }
        else {
            $user_id = $request->user_id;
        }

        $class = Classes::whereTeacherId($user_id)->get();
        $fractal = fractal()->collection($class, new ClassesTransformer);

       return response()->json($fractal->toArray());
    }

    /**
     * Class Details
     *
     * @api {get} HOST/api/class/{id} Class Details
     * @apiVersion 1.0.0
     * @apiName ClassDetail
     * @apiDescription Returns the details of the class
     * @apiGroup Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
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
     * @apiSuccess {Date} schedules.from Session start
     * @apiSuccess {Date} schedules.to Session end
     * @apiSuccess {Number} schedules.status Session status: done, canceled
     * @apiSuccess {Number} schedules.teacher teacher handling this session
     * @apiSuccess {Number} schedules.teacher.id
     * @apiSuccess {String} schedules.teacher.first_name Teacher name
     * @apiSuccess {String} schedules.teacher.last_name Teacher name
     * @apiSuccess {Array} schedules.materials Class resources: notes, lessons, etc
     * @apiSuccess {Number} schedules.materials.id Unique material id
     * @apiSuccess {String} schedules.materials.title
     * @apiSuccess {String} schedules.materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} schedules.materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Object} schedules.materials.added_by Someone who added the material
     * @apiSuccess {Number} schedules.materials.added_by.id ID of uploader
     * @apiSuccess {String} schedules.materials.added_by.name Name of uploader
     * @apiSuccess {Array} schedules.activities List of activities attached to the session
     * @apiSuccess {Number} schedules.activities.id The activity id
     * @apiSuccess {String} schedules.activities.title 
     * @apiSuccess {String} schedules.activities.instruction 
     * @apiSuccess {Date} schedules.activities.available_from Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Date} schedules.activities.available_to Empty if it's a class activity. Date will be specified if given as assignment 
     * @apiSuccess {Array} schedules.activities.materials Array of reading materials needed for this activity
     * @apiSuccess {Number} schedules.activities.materials.id 
     * @apiSuccess {String} schedules.activities.materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} schedules.activities.materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Array} students List of students enrolled in the class
     * @apiSuccess {Number} students.id ID of student
     * @apiSuccess {Number} students.name Name of student
     * @apiSuccess {Number} students.user_type 's' => student by  default
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "name": "English 101",
            "description": "learn basics",
            "frequency": "M,W,F",
            "date_from": "2020-05-11",
            "date_to": "2020-05-15",
            "time_from": "09:00:00",
            "time_to": "10:00:00",
            "subject": {
                "id": 1,
                "name": "English"
            },
            "teacher": {
                "id": 8,
                "name": "teacher tom"
            },
            "schedules": [
                {
                    "id": 1,
                    "date": "2020-05-11",
                    "status": 0,
                    "is_active": false,
                    "materials": [
                        {
                            "id": 1,
                            "title": "English Writing Part 1",
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
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-writing-part2",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
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
                            "materials": [
                                {
                                    "id": 3,
                                    "uploaded_file": "",
                                    "resource_link": "http://read-english.com/basics3"
                                }
                            ]
                        }
                    ]
                },
                {
                    "id": 2,
                    "date": "2020-05-13",
                    "status": 0,
                    "is_active": false,
                    "materials": [
                        {
                            "id": 3,
                            "title": "English Speaking",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-speaking",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        }
                    ],
                    "activities": []
                },
                {
                    "id": 3,
                    "date": "2020-05-15",
                    "status": 0,
                    "is_active": true,
                    "materials": [
                        {
                            "id": 4,
                            "title": "English Grammar",
                            "uploaded_file": null,
                            "resource_link": "https://sample-lesson-link.com/english-grammar",
                            "added_by": {
                                "id": 8,
                                "name": "teacher tom"
                            }
                        }
                    ],
                    "activities": []
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
        }
     *
     * 
     * 
     */
    public function show(Request $request)
    {
        //todo: add policy that only teacher/student related to class can view
        $class = Classes::whereId($request->id)->first();

        $fractal = fractal()->item($class, new ClassesTransformer);
        $fractal->includeSchedules();
        $fractal->includeStudents();

       return response()->json($fractal->toArray());
    }

    /**
     * Class Attendance
     *
     * @api {get} HOST/api/class/attendance/{class_id} Class Attendance
     * @apiVersion 1.0.0
     * @apiName Attendance
     * @apiDescription Returns list of users present in each class session
     * @apiGroup Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} class_id the class ID
     *
     * @apiSuccess {Number} schedule_id class schedule
     * @apiSuccess {Date} date session date
     * @apiSuccess {String={"",canceled}} status session status
     * @apiSuccess {Number} is_active true if session date = current date, false otherwise
     * @apiSuccess {Array} attendances List of users present in the current session
     * @apiSuccess {Number} attendances.user_id
     * @apiSuccess {String} attendances.username
     * @apiSuccess {String} attendances.name
     * @apiSuccess {String} attendances.user_type
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "schedule_id": 1,
                "date": "2020-05-11",
                "status": "",
                "is_active": false,
                "attendances": [
                    {
                        "user_id": 1,
                        "username": "jayson",
                        "name": "jayson",
                        "user_type": "s"
                    },
                    {
                        "user_id": 2,
                        "username": "grace",
                        "name": "grace",
                        "user_type": "s"
                    },
                    {
                        "user_id": 3,
                        "username": "jen",
                        "name": "jen",
                        "user_type": "s"
                    },
                    {
                        "user_id": 4,
                        "username": "davy",
                        "name": "davy",
                        "user_type": "s"
                    }
                ]
            },
            {
                "schedule_id": 2,
                "date": "2020-05-13",
                "status": "",
                "is_active": false,
                "attendances": [
                    {
                        "user_id": 1,
                        "username": "jayson",
                        "name": "jayson",
                        "user_type": "s"
                    },
                    {
                        "user_id": 2,
                        "username": "grace",
                        "name": "grace",
                        "user_type": "s"
                    },
                    {
                        "user_id": 3,
                        "username": "jen",
                        "name": "jen",
                        "user_type": "s"
                    }
                ]
            },
            {
                "schedule_id": 3,
                "date": "2020-05-15",
                "status": "",
                "is_active": true,
                "attendances": [
                    {
                        "user_id": 1,
                        "username": "jayson",
                        "name": "jayson",
                        "user_type": "s"
                    },
                    {
                        "user_id": 2,
                        "username": "grace",
                        "name": "grace",
                        "user_type": "s"
                    },
                    {
                        "user_id": 4,
                        "username": "davy",
                        "name": "davy",
                        "user_type": "s"
                    }
                ]
            }
        ]
     *
     * 
     * 
     */
    
    public function attendance(Request $request)
    {
        $user =  Auth::user();
        $schedule = Schedule::whereClassId($request->id)->get();

        $fractal = fractal()->collection($schedule, new ScheduleAttendanceTransformer);


       return response()->json($fractal->toArray());
    }


        /**
     * Student Classes List
     *
     * @api {get} HOST/api/student/classes Student Classes List
     * @apiVersion 1.0.0
     * @apiName StudentClassList
     * @apiDescription Returns the list of class of logged in student
     * @apiGroup Classes
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Number} id the student's unique ID
     * @apiSuccess {String} first_name
     * @apiSuccess {String} last_name
     * @apiSuccess {Number} school_id
     * @apiSuccess {String} user_type
     * @apiSuccess {Array} classes list of classes
     * @apiSuccess {Number} classes.id the class ID
     * @apiSuccess {String} classes.name
     * @apiSuccess {String} classes.description
     * @apiSuccess {String} classes.frequency
     * @apiSuccess {Date} classes.date_from
     * @apiSuccess {Date} classes.date_to
     * @apiSuccess {Date} classes.time_from
     * @apiSuccess {Date} classes.time_to
     * @apiSuccess {Object} subject
     * @apiSuccess {Number} subject.id the subject ID
     * @apiSuccess {String} subject.name
     * @apiSuccess {Object} teacher
     * @apiSuccess {Number} teacher.id teacher ID
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "first_name": "jayson",
            "last_name": "barino",
            "school_id": 1,
            "user_type": "s",
            "classes": [
                {
                    "id": 1,
                    "name": "English 101",
                    "description": "learn basics",
                    "frequency": "M,W,F",
                    "date_from": "2020-05-11",
                    "date_to": "2020-05-15",
                    "time_from": "09:00:00",
                    "time_to": "10:00:00",
                    "subject": {
                        "id": 1,
                        "name": "English"
                    },
                    "teacher": {
                        "id": 8,
                        "first_name": "teacher tom",
                        "last_name": "cruz"
                    }
                },
                {
                    "id": 2,
                    "name": "Science 101",
                    "description": "science experiments",
                    "frequency": "T,TH",
                    "date_from": "2020-05-11",
                    "date_to": "2020-05-15",
                    "time_from": "11:00:00",
                    "time_to": "12:00:00",
                    "subject": {
                        "id": 4,
                        "name": "Science"
                    },
                    "teacher": {
                        "id": 8,
                        "first_name": "teacher tom",
                        "last_name": "cruz"
                    }
                }
            ]
        }
     *
     * 
     * 
     */
    public function studentClasses(Request $request)
    {
        $user_id = Auth::user()->getKey();

        $user = User::whereId($user_id)->with('classes')->first();
        $fractal = fractal()->item($user, new UserTransformer);
        $fractal->includeClasses();

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
