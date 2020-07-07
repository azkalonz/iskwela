<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\AttendanceTransformer;
use App\Transformers\AttendanceReportTransformer;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\SectionStudent;
use App\TransferObjects\AttendanceData;

class AttendanceController extends Controller
{
    /**
     * Record Attendance
     *
     * @api {post} HOST/api/class/attendance/save Record Attendance
     * @apiVersion 1.0.0
     * @apiName RecordAttendance
     * @apiDescription Records the user's class attendance
     * @apiGroup Reports
     *
     * @apiParam {Number} student_id the student ID
     * @apiParam {Number} schedule_id the schedule ID
     * @apiParam {Number} class_id the class ID
     *
     * @apiSuccess {Number} student_id the class ID
     * @apiSuccess {String} username
     * @apiSuccess {String} first_name
     * @apiSuccess {String} last_name
     * @apiSuccess {String} user_type
     * @apiSuccess {Number} class_id the class ID
     * @apiSuccess {Object} schedule
     * @apiSuccess {Number} schedule.id the schedule ID
     * @apiSuccess {DateTime} schedule.date_from session start date/time
     * @apiSuccess {DateTime} schedule.date_to session end date/time
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "student_id": 1,
            "username": "jayson",
            "first_name": "jayson",
            "last_name": "barino",
            "user_type": "s",
            "class_id": 1,
            "schedule": {
                "id": 1,
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00"
            }
        }
    */
    public function record(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'student_id' => 'integer|required'
        ]);


        $attendance = Attendance::updateOrCreate([
            'user_id' => $request->student_id,
            'schedule_id' => $request->schedule_id,
            'class_id' => $request->class_id
        ]);

        $fractal = fractal()->item($attendance, new AttendanceTransformer);
        return response()->json($fractal->toArray());
    }

    /**
     * Class Attendance
     *
     * @api {get} HOST/api/class/attendance/:id Attendance Report
     * @apiVersion 1.0.0
     * @apiName ClassAttendance
     * @apiDescription Returns the attendance report of all users in the class
     * @apiGroup Reports
     *
     * @apiParam {Number} id the class ID
     *
     * @apiSuccess {Number} class_id the class ID
     * @apiSuccess {Number} class_attendance_count the "perfect" attendance of the class
     * @apiSuccess {Array} students list of students with attendance info
     * @apiSuccess {Number} students.id the student ID
     * @apiSuccess {String} students.first_name
     * @apiSuccess {String} students.last_name
     * @apiSuccess {Number} students.attendance user attendance count
     * @apiSuccess {Number} students.absence user absence count
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "class_id": 1,
            "class_attendance_count": 3,
            "students": [
                {
                    "id": 1,
                    "first_name": "jayson",
                    "last_name": "barino",
                    "attendance": 3,
                    "absence": 0
                },
                {
                    "id": 2,
                    "first_name": "grace",
                    "last_name": "ungui",
                    "attendance": 3,
                    "absence": 0
                },
                {
                    "id": 3,
                    "first_name": "jen",
                    "last_name": "castillo",
                    "attendance": 2,
                    "absence": 1
                },
                {
                    "id": 4,
                    "first_name": "davy",
                    "last_name": "castillo",
                    "attendance": 2,
                    "absence": 1
                }
            ]
        }
     *
     * 
     * 
     */
    public function attendance(Request $request)
    {
       $id = $request->id;
        $class = Classes::with([
            'sectionStudents' => function($students) use($id) {
                $students->withCount(['attendance' => function($a) use ($id){
                    $a->where('class_id', $id);
                }]);
            }])
        ->withCount(['schedules' => function($sched) {
            $sched->whereRaw(
                'date_from <= ?', date('Y-m-d H:i:s')
            );
        }])   
        ->whereId($request->id)->first();

        $attendance_report = AttendanceData::create([
            'class_id' => $class->id,
            'attendance_count' => $class->schedules_count,
            'students' => $class->sectionStudents
        ]);

        $fractal = fractal()->item($attendance_report, new AttendanceReportTransformer);
        return response()->json($fractal->toArray());

    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
