<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Transformers\ClassesTransformer;
use App\Transformers\ScheduleTransformer;
use App\Transformers\ScheduleAttendanceTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\UserPreferenceTransformer;
use App\Transformers\ClassMaterialTransformer;

use Auth;
use App\Models\User;
use App\Models\Schedule;
use App\Models\ClassMaterial;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Str;
class ClassController extends Controller
{

    /**
     * Teacher Class List
     *
     * @api {GET} <HOST>/api/teacher/classes Get class list
     * @apiVersion 1.0.0
     * @apiName TeacherClassList
     * @apiDescription Returns array of classes handled by teacher
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=students,schedules} include available includes when getting the class list
     * @apiParam {StringOrNumber} user_id retrieves list of classes of the specified user. If not passed, defaults to currently logged in user: "me"
     *
     * @apiSuccess {Number} id Unique class id
     * @apiSuccess {String} name Defined class name
     * @apiSuccess {String} description Class description
     * @apiSuccess {String} bg_image class background image
     * @apiSuccess {Number} room_number
     * @apiSuccess {String} frequency The frequency of session
     * @apiSuccess {String} color The color assigned to the class
     * @apiSuccess {Date} date_from Start of class
     * @apiSuccess {Date} date_to End of class
     * @apiSuccess {Time} time_from Class duration
     * @apiSuccess {Time} time_to Class duration
     * @apiSuccess {Object} next_schedule the next session
     * @apiSuccess {Timestamp} next_schedule.from
     * @apiSuccess {Timestamp} next_schedule.to
     * @apiSuccess {String} next_schedule.status
     * @apiSuccess {Object} teacher The teacher handling the class
     * @apiSuccess {Number} teacher.id Unique teacher id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {Array} students refer to <a href='#api-Teacher_Classes-ClassDetail'>/api/teacher/class/:id</a> for the details
     * @apiSuccess {Array} schedules refer to <a href='#api-Teacher_Classes-ClassDetail'>/api/teacher/class/:id</a> for the details
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "name": "English 101",
                "description": "learn basics",
                "bg_image": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg",
                "room_number": 123455,
                "frequency": "M,W,F",
                "color": "#b12d8b",
                "date_from": "2020-05-11",
                "date_to": "2020-05-15",
                "time_from": "09:00:00",
                "time_to": "10:00:00",
                "next_schedule": {
                    "from": "2020-05-25 09:00:00",
                    "to": "2020-05-25 10:00:00"
                    "status": "DONE"
                },
                "subject": {
                    "id": 1,
                    "name": "English"
                },
                "teacher": {
                    "id": 8,
                    "first_name": "teacher tom",
                    "last_name": "cruz",
                    "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
                }
                "students": [
                    {},
                    {}
                ]
                "schedules": [
                    {},
                    {}
                ]
            },
            {},
            {}
        ]
     *
     * 
     * 
     */

    public function teacherClasses(Request $request)
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

    public function adminClasses(Request $request)
    {
        //$admin = array('a', 'su'); 
        $user = Auth::user();

        if($user->user_type == 'a')
        {
            $school_id = $user->school_id;
        }
        else if ($user->user_type == 'su')
        {
            $school_id = $request->school_id ?? $user->school_id;
        }
        else{
            return response('Unauthorized', 401);
        }
        
        $teacher_id = $request->teacher_id ?? 0;

        $class = Classes::with([
                'teacher' => function($query) use ($school_id) {
                $query->whereSchoolId($school_id);
            }
        ])->inSchool($school_id);

        if($teacher_id > 0)
        {
            $class = $class->whereTeacherId($teacher_id);
        }

        //$class = Classes::whereTeacherId(8);

        //dd($class->toSql());

        $fractal = fractal()->collection($class->get(), new ClassesTransformer);
        return response()->json($fractal->toArray());
    }

    /**
     * Class Details
     *
     * @api <HOST>/api/teacher/class/:id Get class details
     * @apiVersion 1.0.0
     * @apiName ClassDetail
     * @apiDescription Returns a class object of the specified {id}
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     * @apiParam {String=schedules,students} include available relations to include
     *
     * @apiSuccess {Number} id Unique class id
     * @apiSuccess {String} name Defined class name
     * @apiSuccess {String} description Class description
     * @apiSuccess {String} bg_image class background image
     * @apiSuccess {String} frequency The frequency of session
     * @apiSuccess {String} color The color assigned to the class
     * @apiSuccess {Date} date_from Start of class
     * @apiSuccess {Date} date_to End of class
     * @apiSuccess {Time} time_from Class duration
     * @apiSuccess {Time} time_to Class duration
     * @apiSuccess {Object} next_schedule the next session
     * @apiSuccess {Timestamp} next_schedule.from
     * @apiSuccess {Timestamp} next_schedule.to
     * @apiSuccess {Object} subject 
     * @apiSuccess {Number} subject.id 
     * @apiSuccess {String} subject.name The subject name
     * @apiSuccess {Object} teacher the class adviser
     * @apiSuccess {Number} teacher.id
     * @apiSuccess {String} teacher.first_name
     * @apiSuccess {String} teacher.last_name
     * @apiSuccess {String} teacher.profile_picture
     * @apiSuccess {Array} schedules array of class schedules; not included by default
     * @apiSuccess {Number} schedules.id the schedule ID
     * @apiSuccess {Date} schedules.from date/time start of session
     * @apiSuccess {Date} schedules.to date/time end of session
     * @apiSuccess {Object} schedules.teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} schedules.teacher.id
     * @apiSuccess {String} schedules.teacher.first_name
     * @apiSuccess {String} schedules.teacher.last_name
     * @apiSuccess {String} schedules.teacher.profile_picture
     * @apiSuccess {String} schedules.status "" or CANCELED
     * @apiSuccess {Array} students array of students enrolled in the class; not included by default
     * @apiSuccess {Number} students.id
     * @apiSuccess {String} students.first_name
     * @apiSuccess {String} students.last_name
     * @apiSuccess {Number} students.school_id
     * @apiSuccess {String} students.user_type
     * @apiSuccess {String} students.username
     * @apiSuccess {String} students.email
     * @apiSuccess {Number} students.phone_number
     * @apiSuccess {Number} students.status 1:active, 0-inactive
     * @apiSuccess {Object} students.preferences user preferences
     * @apiSuccess {String} students.preferences.profile_picture
     * @apiSuccess {Number} students.preferences.push_notfication
     * @apiSuccess {Number} students.preferences.email_subscription
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "name": "English 101",
            "description": "learn basics",
            "bg_image": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg",
            "frequency": "M,W,F",
            "date_from": "2020-05-11",
            "date_to": "2020-05-15",
            "time_from": "09:00:00",
            "time_to": "10:00:00",
            "next_schedule": {
                "from": "2020-05-25 09:00:00",
                "to": "2020-05-25 10:00:00"
            },
            "color": "#b12d8b",
            "subject": {
                "id": 1,
                "name": "English"
            },
            "teacher": {
                "id": 8,
                "first_name": "teacher tom",
                "last_name": "cruz",
                "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"
            },
            "schedules": [
                {
                    "id": 1,
                    "from": "2020-05-15 09:00:00",
                    "to": "2020-05-15 10:00:00",
                    "teacher": {
                        "id": 8,
                        "first_name": "teacher tom",
                        "last_name": "cruz",
                        "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg"

                    },
                    "status": ""
                },
                {},
            {}
            ],
            "students": [
                {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino",
                    "school_id": 1,
                    "user_type": "s",
                    "username": "jayson",
                    "email": "barinojayson@gmail.con",
                    "phone_number": 111,
                    "status": 1,
                    "preferences": {
                        "profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/ZeXzRdWwYqb1McKBsuCYhfOJHHBAwB4f31f8NmVN.jpeg",
                        "push_notification": 1,
                        "email_subscription": 0
                    }
                },
                {},
                {}
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
        $fractal_arr = $fractal->toArray();

        // hack to re-use the UserTransformer
        // could be improved in the future
        if(isset($fractal_arr['students'])) {
            $stud_list = $this->serializedUserList($fractal_arr['students']);
            $fractal_arr['students'] = $stud_list;
        }



       return response()->json($fractal_arr);
    }

    /**
     * Class Student list
     *
     * @api <HOST>/api/teacher/class-students/:id Get list of students
     * @apiVersion 1.0.0
     * @apiName ClassStudentList
     * @apiDescription Returns array of students enrolled in the class
     * @apiGroup Teacher Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {id} id the student ID
     * @apiSuccess {String} first_name Defined class name
     * @apiSuccess {String} last_name Class description
     * @apiSuccess {Number} school_id
     * @apiSuccess {String} user_type
     * @apiSuccess {String} username
     * @apiSuccess {String} email
     * @apiSuccess {Number} phone_number
     * @apiSuccess {Number} status 1:active, 0-inactive
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "first_name": "jayson",
                "last_name": "barino",
                "school_id": 1,
                "user_type": "s",
                "user_name": "jayson",
                "email": "barinojayson@gmail.con",
                "phone_number": 111,
                "status": 1
            },
            {},
            {}
        ]
     * 
     * 
     */
    public function classStudentList(Request $request)
    {
        $includes = ['sectionStudents', 'sectionStudents.user'];
        $student_list = Classes::whereId($request->id)->with($includes)->first();

        $fractal = fractal()->item($student_list, new ClassesTransformer);
        $fractal->includeStudents();

        // serialize students list
        // hack to make use of UserTransformer
        $fractal_arr = $fractal->toArray();
        $fractal_arr['students'] = collect($fractal_arr['students'])->map(function($object) {
            return $object['user'];
        });

        return response()->json($fractal_arr['students']);
    }


    /**
     * Student Class List
     *
     * @api {get} HOST/api/student/classes get class list
     * @apiVersion 1.0.0
     * @apiName StudentClassList
     * @apiDescription Returns array of classes where the logged in student is currently enrolled
     * @apiGroup Student Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} student_id User ID of the student. Required if logged in as a parent
     * 
     * @apiSuccess {id} id the student ID
     * @apiSuccess {String} first_name 
     * @apiSuccess {String} last_name 
     * @apiSuccess {Number} school_id
     * @apiSuccess {String} user_type
     * @apiSuccess {String} username
     * @apiSuccess {String} email
     * @apiSuccess {Number} phone_number
     * @apiSuccess {Number} status 1:active, 0-inactive
     * @apiSuccess {Array} classes list of classes
     * @apiSuccess {Number} classes.id the class ID
     * @apiSuccess {String} classes.name
     * @apiSuccess {String} classes.description
     * @apiSuccess {String} classes.bg_image class background image
     * @apiSuccess {String} classes.frequency
     * @apiSuccess {Date} classes.date_from
     * @apiSuccess {Date} classes.date_to
     * @apiSuccess {Date} classes.time_from
     * @apiSuccess {Date} classes.time_to
     * @apiSuccess {Object} next_schedule the next session
     * @apiSuccess {Timestamp} next_schedule.from
     * @apiSuccess {Timestamp} next_schedule.to
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
            "user_name": "jayson",
            "email": "barinojayson@gmail.con",
            "phone_number": 111,
            "status": 1,
            "classes": [
                {
                    "id": 1,
                    "name": "English 101",
                    "description": "learn basics",
                    "bg_image": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg",
                    "frequency": "M,W,F",
                    "date_from": "2020-05-11",
                    "date_to": "2020-05-15",
                    "time_from": "09:00:00",
                    "time_to": "10:00:00",
                    "next_schedule": {
                        "from": "2020-05-25 09:00:00",
                        "to": "2020-05-25 10:00:00"
                    },
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
                {},
                {}
            ]
        }
     *
     * 
     * 
     */
    public function studentClasses(Request $request)
    {
        $currentUser = Auth::user();

        if($currentUser->user_type == 'p')
        {
            $this->validate($request, [
                'student_id' => 'integer|required'
            ]);
            $student_id = $request->student_id;
        }else{
            $student_id = $currentUser->id;
        }

        $user = User::whereId($student_id)->with('classes')->first();
        $fractal = fractal()->item($user, new UserTransformer);
        $fractal->includeClasses();

        return response()->json($fractal->toArray());
    }


    /**
     * Class Details
     *
     * @api <HOST>/api/teacher/class/:id Get class details
     * @apiVersion 1.0.0
     * @apiName ClassDetail
     * @apiDescription Returns a class object of the specified {id}
     * @apiGroup Student Classes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the class ID
     * @apiParam {String=schedules} include available relations to include
     *
     * @apiSuccess {Number} id Unique class id
     * @apiSuccess {String} name Defined class name
     * @apiSuccess {String} description Class description
     * @apiSuccess {String} bg_image class background image
     * @apiSuccess {String} frequency The frequency of session
     * @apiSuccess {Date} date_from Start of class
     * @apiSuccess {Date} date_to End of class
     * @apiSuccess {Time} time_from Class duration
     * @apiSuccess {Time} time_to Class duration
     * @apiSuccess {Object} next_schedule the next session
     * @apiSuccess {Timestamp} next_schedule.from
     * @apiSuccess {Timestamp} next_schedule.to
     * @apiSuccess {Object} subject 
     * @apiSuccess {Number} subject.id 
     * @apiSuccess {String} subject.name The subject name
     * @apiSuccess {Object} teacher The teacher handling the class
     * @apiSuccess {Number} teacher.id Unique teacher id
     * @apiSuccess {String} teacher.name The teacher's name
     * @apiSuccess {Array} schedules array of class schedules; not included by default
     * @apiSuccess {Number} schedules.id the schedule ID
     * @apiSuccess {Date} schedules.from date/time start of session
     * @apiSuccess {Date} schedules.to date/time end of session
     * @apiSuccess {Object} schedules.teacher the teacher handling this session (could be different from the class adviser if re-assignment happens)
     * @apiSuccess {Number} schedules.teacher.id
     * @apiSuccess {String} schedules.teacher.first_name
     * @apiSuccess {String} schedules.teacher.last_name
     * @apiSuccess {String} schedules.status "" or CANCELED
     * @apiSuccess {Array} students array of students enrolled in the class; not included by default
     * @apiSuccess {Number} students.id
     * @apiSuccess {String} students.first_name
     * @apiSuccess {String} students.last_name
     * @apiSuccess {Number} students.school_id
     * @apiSuccess {String} students.user_type
     * @apiSuccess {String} students.username
     * @apiSuccess {String} students.email
     * @apiSuccess {Number} students.phone_number
     * @apiSuccess {Number} students.status 1:active, 0-inactive
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "name": "English 101",
            "description": "learn basics",
            "bg_image": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg",
            "frequency": "M,W,F",
            "date_from": "2020-05-11",
            "date_to": "2020-05-15",
            "time_from": "09:00:00",
            "time_to": "10:00:00",
            "next_schedule": {
                "from": "2020-05-25 09:00:00",
                "to": "2020-05-25 10:00:00"
            },
            "color": "#b12d8b",
            "subject": {
                "id": 1,
                "name": "English"
            },
            "teacher": {
                "id": 8,
                "first_name": "teacher tom",
                "last_name": "cruz"
            },
            "schedules": [
                {
                    "id": 1,
                    "from": "2020-05-15 09:00:00",
                    "to": "2020-05-15 10:00:00",
                    "teacher": {
                        "id": 8,
                        "first_name": "teacher tom",
                        "last_name": "cruz"
                    },
                    "status": ""
                },
                {},
            {}
            ],
            "students": [
                {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino",
                    "school_id": 1,
                    "user_type": "s",
                    "username": "jayson",
                    "email": "barinojayson@gmail.con",
                    "phone_number": 111,
                    "status": 1
                },
                {},
                {}
            ]
        }
     *
     * 
     * 
     */
    public function showStudentClass(Request $request)
    {
        $this->validate($request, [
            'include' => 'in:schedules'
        ]);
        //todo: add policy that only student related to class can view
        $class = Classes::whereId($request->id)->first();

        $fractal = fractal()->item($class, new ClassesTransformer);
        $fractal_arr = $fractal->toArray();

        // hack to re-use the UserTransformer
        // could be improved in the future
        if(isset($fractal_arr['students'])) {
            $stud_list = $this->serializedUserList($fractal_arr['students']);
            $fractal_arr['students'] = $stud_list;
        }

       return response()->json($fractal_arr);
    }


    /**
     * Remove Class Material
     *
     * @api {post} HOST/api/teacher/remove/class-material/:id Remove Class Material
     * @apiVersion 1.0.0
     * @apiName RemoveClassMaterial
     * @apiDescription Removes a Class Material
     * @apiGroup Teacher Classes
     *
     * @apiParam {Number} id ID of Class Material
     *
     * @apiSuccess {String} success returns true if ID is found. Otherwise, returns error code 404.
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */
    public function removeClassMaterial(Request $request)
    {
        //to do: policy on who can remove
		$class_material = ClassMaterial::findOrFail($request->id);
        $class_material->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove Class
     *
     * @api {post} HOST/api/teacher/remove/class/:id Remove Class
     * @apiVersion 1.0.0
     * @apiName RemoveClass
     * @apiDescription Removes a Class
     * @apiGroup Teacher Classes
     *
     * @apiParam {Number} id ID of Class Material
     *
     * @apiSuccess {String} success returns true if ID is found. Otherwise, returns error code 404.
     *
     *
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     */
    public function removeClass(Request $request)
    {
        //to do: policy on who can remove classes
		$class = Classes::with('schedules')->findOrFail($request->id);

        // TODO: remove class schedules?
        // TODO: remove class topics?
        // TODO: remove assignments?
        // TODO: remove assets?
        // TODO: when removing orphaned items of a class, 
        // consider using queue jobs to prevent timeout issues

        $class->delete();

        return response()->json(['success' => true]);
    }

    private function serializedUserList(Array $list)
    {
        $serialized_list = collect($list)->map(function($object) {
            return $object['user'];
        });

        return $serialized_list->toArray();
    }

    public function saveClass(Request $request)
    {
        $this->validate($request, [
            'teacher_id' => 'integer',
            'subject_id' => 'integer',
            'year_id' => 'integer',
            'section_id' => 'integer'
        ]);

        $user = Auth::user();
        $previous_dow = Array();
        $mysql_dow = array("", "u", "m", "t", "w", "r", "f", "s");

        if($request->id)
        {
            $class = Classes::findOrFail($request->id);
            $class->updated_by = $user->id;
            //$previous_dow = explode(',', $class->frequency);
            $previous_date_to = $class->date_to;
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $class = new Classes();
            $class->created_by = $user->id;
            $class->updated_by = $user->id;
            $previous_date_to = null;
        }

        $class->name = $request->name ?? $class->name;
        $class->description = $request->description ?? $class->description;
        $class->teacher_id = $request->teacher_id ?? $class->teacher_id;
        $class->subject_id = $request->subject_id ?? $class->subject_id;
        $class->year_id = $request->year_id ?? $class->year_id;
        $class->section_id = $request->section_id ?? $class->section_id;
        $class->color = $request->color ?? $class->color ?? $this->generateClassColor();
        $class->room_number = $request->room_id ?? $class->room_number ?? $this->generateRoomNumber();
        $class->date_from = $request->date_from ?? $class->date_from;
        $class->date_to = $request->date_to ?? $class->date_to;
        $class->time_from = $request->time_from ?? $class->time_from;
        $class->time_to = $request->time_to ?? $class->time_to;
        $class->frequency = strtolower($request->frequency) ?? $class->frequency;
        $class->save();

        if($request->date_from && $request->date_to && $request->time_from && $request->time_to && $request->frequency)
        {
            //if schedule info is given in the request, generate schedules

            $schedules_dow = DB::table('schedules')
            ->select(DB::raw('DISTINCT DAYOFWEEK(date_from) as day_of_week'))
            ->where('class_id', '=', $class->id)
            ->get()->toArray();
            //dd($previous_dow);
            foreach($schedules_dow as $dow){
                array_push($previous_dow, $mysql_dow[$dow->day_of_week]);
            }
            //dd($previous_dow);
            $this->generateClassSchedules($class, $class->teacher_id, $previous_dow, $previous_date_to);
        }

        $fractal = fractal()->item($class, new ClassesTransformer);
        return response()->json($fractal->toArray());

    }
    private function generateRoomNumber()
    {
        return Str::random(32);
    }

    private function generateClassColor()
    {
        $colors = config("school_hub.colors");
        return $colors[ array_rand($colors) ];
    }

    private function generateClassSchedules(Classes $class, $teacher_id, Array $previous_dow, $previous_date_to)
    {

        //generate schedules only if there no exist schedules
        $frequency = Array();
        $reschedule = false;

        $hours_start_int = (int)str_replace(':','.',$class->time_from);
        $hours_end_int = (int)str_replace(':','.',$class->time_to);

        $frequency = explode(',', $class->frequency);


        foreach($frequency as $day_of_week)
        {
            
            if(in_array($day_of_week, $previous_dow))
            {
                //schedule exist for specified day of week.
                $reschedule = true;
            }
            else
            {
                /* day of week schedule is new */
                $date_from = $class->date_from;
                $date_to = $previous_date_to ?? $class->date_to; /* if there exist a previous date to, use it. the new dates will be handled in if($previous_date_to) */
                $this->createSchedulesByDayOfWeek($class, $teacher_id, $date_from, $date_to, $day_of_week);
            }

            if($previous_date_to)
            {
                if(strtotime($previous_date_to) < strtotime($class->date_to))
                {
                    //new schedules are added to the class
                    $date_from = Date("Y-m-d", strtotime("+1 day", strtotime($previous_date_to)));
                    $date_to = $class->date_to;
                    $this->createSchedulesByDayOfWeek($class, $teacher_id, $date_from, $date_to, $day_of_week);
                }
            }
        }

        if($previous_date_to)
        {
            if(strtotime($previous_date_to) > strtotime($class->date_to))
            {
                //schedule has been shortened
                $this->removeSchedulesByEndDate($class);
            }
        }
        
        $this->removeSchedulesByDayOfWeek($class->id, $frequency);

        if($reschedule)
        {
            $this->reschedule($class);
        }
    }

    private function reschedule(Classes $class)
    {
        $schedules = Schedule::whereClassId($class->id)->where('date_from', '>=', Date("Y-m-d", time()))->update(
            [
                'date_from' => DB::raw("concat(date(`date_from`), ' ".$class->time_from."')"),
                'date_to' => DB::raw("concat(date(`date_to`), ' ".$class->time_to."')"),
                'teacher_id' => $class->teacher_id
            ]
        );
    }

    private function removeSchedulesByDayOfWeek(int $class_id, Array $new_dow)
    {
        $dow_code_arr = array(
            "u" => "6",
            "m" => "0",
            "t" => "1",
            "w" => "2",
            "r" => "3",
            "f" => "4",
            "s" => "5"
            );
        
        $dow_arr = array("u", "m", "t", "w", "r", "f", "s");

        foreach($dow_arr as $dow)
        {
            if(!in_array($dow, $new_dow))
            {
                //previous schedule exist but is no longer needed
                $schedule = Schedule::whereClassId($class_id)->whereRaw('WEEKDAY(date_from)='.$dow_code_arr[$dow])->delete();
            }
        }
    }

    private function removeSchedulesByEndDate(Classes $class)
    {
        $Schedules = Schedule::whereClassId($class->id)->where('date_to', '>', Date("Y-m-d", strtotime("+1 day", strtotime($class->date_to))))->delete();
    }

    private function createSchedulesByDayOfWeek(Classes $class, $teacher_id, $date_from, $date_to, $day_of_week)
    {
        $start_date_dow = date('w', strtotime($date_from));

        $dow_code_arr = array(
            "u" => "sunday",
            "m" => "monday",
            "t" => "tuesday",
            "w" => "wednesday",
            "r" => "thursday",
            "f" => "friday",
            "s" => "saturday"
            );
        
        $dow_int_arr = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");

        $day_of_week_full = $dow_code_arr[$day_of_week];

        if($dow_int_arr[$start_date_dow] == $day_of_week_full)
        {
            $schedule_start_datetime = strtotime($date_from);
        }
        else
        {
            $schedule_start_datetime = strtotime('next '.$day_of_week_full, strtotime($date_from));
        }

        $schedules = collect();

        for($datetime_traverser = $schedule_start_datetime; $datetime_traverser <= strtotime($date_to); $datetime_traverser = strtotime('+1 week', $datetime_traverser))
        {

            $schedules->push(
                [
                    'class_id' => $class->id,
                    'teacher_id' => $teacher_id,
                    'date_from' => date('Y-m-d',  $datetime_traverser).' '.$class->time_from,
                    'date_to' => date('Y-m-d',  $datetime_traverser).' '.$class->time_to,
                    'status' => 0
                ]
            );
        }

        Schedule::insert($schedules->toArray());
    }
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}