<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\AttendanceTransformer;
use App\Transformers\AttendanceReportDataTransformer;
use App\Transformers\UserAttendanceDataTransformer;
use App\Transformers\ScheduleAttendanceDataTransformer;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\User;
use App\Models\Schedule;
use App\Models\SectionStudent;
use App\TransferObjects\AttendanceReportData;
use App\TransferObjects\UserAttendanceData;
use App\TransferObjects\ScheduleAttendanceData;

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
     * @apiParam {Number=1,2} status default is 1 if not specified <br> 1: Present, 2: Absent
     * @apiParam {String} reason
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
     * @apiSuccess {Object} schedule.attendance
     * @apiSuccess {Number} schedule.attendance.attendance_id the attendance record ID
     * @apiSuccess {Number} schedule.attendance.status 1:Present 2:Absent
     * @apiSuccess {String} schedule.attendance.remark
     * @apiSuccess {String} schedule.attendance.reason
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "student_id": 2,
            "username": "grace",
            "first_name": "grace",
            "last_name": "ungui",
            "user_type": "s",
            "class_id": 1,
            "schedule": {
                "id": 3,
                "from": "2020-05-19 09:00:00",
                "to": "2020-05-19 10:00:00",
                "attendance": {
                    "attendance_id": 20,
                    "status": 2,
                    "remark": "Absent",
                    "reason": "tired3"
                }
            }
        }
    */
    public function record(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'student_id' => 'integer|required',
            'status' => 'integer|in:1,2',
            'reason' => 'string',
            'id' => 'integer'
        ]);

        if($request->id) {
            $attendance = Attendance::find($request->id);
            $attendance->status = $request->status ?? $attendance->status;
            $attendance->reason = $request->reason ?? $attendance->reason;
            $attendance->save();
        }
        else {
            try{
                $attendance = Attendance::updateOrCreate([
                'user_id' => $request->student_id,
                'schedule_id' => $request->schedule_id,
                'class_id' => $request->class_id,
                'status' => $request->status ?? 1,
                'reason' => $request->reason ?? ''
                ]);
            }
            catch(\Exception $e)
            {
                return response('Unable to record the attendance', 500);
            }
        }

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
                    $a->whereStatus(1);
                }]);
            }])
        ->withCount(['schedules' => function($sched) {
            $sched->whereRaw(
                'date_from <= ?', date('Y-m-d H:i:s')
            );
        }])   
        ->whereId($request->id)->first();

        $attendance_report = AttendanceReportData::create([
            'class_id' => $class->id,
            'attendance_count' => $class->schedules_count,
            'students' => $class->sectionStudents
        ]);

        $fractal = fractal()->item($attendance_report, new AttendanceReportDataTransformer);
        return response()->json($fractal->toArray());

    }

    /**
     * Class Attendance
     *
     * @api {get} HOST/api/class/my-attendance User class attendance
     * @apiVersion 1.0.0
     * @apiName UserClassAttendance
     * @apiDescription List of user's class attendance
     * @apiGroup Reports
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Number} user_id the user_id
     *
     * @apiSuccess {Number} schedule_id the schedule id
     * @apiSuccess {NumberOrNull=1,2,null} status_flag the attendance status
     * @apiSuccess {String} remark Values: Present, Absent, No record
     * @apiSuccess {DateTime} from schedule start date/time
     * @apiSuccess {DateTime} to schedule end date/time
     * @apiSuccess {String} reason reasons of absence if any
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "schedule_id": 2,
                "status_flag": 1,
                "remark": "Present",
                "from": "2020-05-18 09:00:00",
                "to": "2020-05-18 10:00:00",
                "reason": null
            },
            {
                "schedule_id": 1,
                "status_flag": 2,
                "remark": "Absent",
                "from": "2020-05-15 09:00:00",
                "to": "2020-05-15 10:00:00",
                "reason": "family gathering"
            },
            {
                "schedule_id": 3,
                "status_flag": 2,
                "remark": "Absent",
                "from": "2020-05-19 09:00:00",
                "to": "2020-05-19 10:00:00",
                "reason": "sick"
            }
        ]
     *
     * 
     * 
     */
    public function details(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'class_id' => 'required|integer'
        ]);

        $attendances = User::selectRaw(
                'classes.id as class_id,
                schedules.id as schedule_id,
                schedules.date_from as `from`,
                schedules.date_to as `to`,
                attendances.status as attendance_status,
                attendances.reason as reason'
            )
            ->attendances($request->class_id, $request->user_id)
            ->get();

        $details = $attendances->map(function($a) {
            return UserAttendanceData::create($a->toArray());
        });

        $fractal = fractal()->collection($details, new UserAttendanceDataTransformer);
        return response()->json($fractal->toArray());
    }

    /**
     * Class Attendance
     *
     * @api {get} HOST/api/class/schedule-attendance Schedule attendance
     * @apiVersion 1.0.0
     * @apiName ScheduleClassAttendance
     * @apiDescription Get attendances of the given schedule ID
     * @apiGroup Reports
     *
     * @apiParam {Number} class_id the class ID
     * @apiParam {Number} schedule_id the schedule_id
     *
     * @apiSuccess {Number} class_id the class ID
     * @apiSuccess {Number} schedule_id the schedule id
     * @apiSuccess {DateTime} from schedule start date/time
     * @apiSuccess {DateTime} to schedule end date/time
     * @apiSuccess {Object} attendance_records list of attendances for this schedule
     * @apiSuccess {Number} attendance_records.user_id
     * @apiSuccess {String} attendance_records.first_name
     * @apiSuccess {String} attendance_records.last_name
     * @apiSuccess {NumberOrNull=1,2,null} attendance_records.status_flag the attendance status
     * @apiSuccess {String} attendance_records.remark Values: Present, Absent, No record
     * @apiSuccess {String} attendance_records.reason reasons of absence if any
     * @apiSuccessExample {json} Sample Response
        {
            "class_id": 2,
            "schedule_id": 2,
            "from": "2020-05-18 09:00:00",
            "to": "2020-05-18 10:00:00",
            "attendance_records": [
                {
                    "user_id": 1,
                    "first_name": "jayson",
                    "last_name": "barino",
                    "status": 1,
                    "remark": "Present",
                    "reason": null
                },
                {},
                {}
            ]
        }
     *
     * 
     * 
     */
    public function scheduleAttendance(Request $request)
    {
        $this->validate($request, [
            'schedule_id' => 'required|integer|exists:schedules,id',
            'class_id' => 'required|integer|exists:classes,id'
        ]);

        $attendances = User::selectRaw(
            'users.id as user_id, users.first_name, users.last_name,
            classes.id as class_id,
            schedules.id as schedule_id,
            schedules.date_from as `from`,
            schedules.date_to as `to`,
            attendances.status as attendance_status,
            attendances.reason as reason'
        )
        ->attendances($request->class_id, null, $request->schedule_id)
        ->get();

        if(!count($attendances)) {
            return response('Unable to retrieve attendance records', 500);
        }

        $records = $attendances->map(function($a) {
            return [
                'user_id' => $a->user_id,
                'first_name' => $a->first_name,
                'last_name' => $a->last_name,
                'status_flag' => $a->attendance_status,
                'remark' => $a->attendance_status ? config('school_hub.attendance_status')[$a->attendance_status] : config('school_hub.attendance_status')[0],
                'reason' => $a->reason
            ];
        });
        $sched = $attendances->first();

        $data = [
            'class_id' => $sched->class_id,
            'schedule_id' => $sched->schedule_id,
            'from' => $sched->from,
            'to' => $sched->to,
            'attendance_records' => $records
        ];

        $fractal = fractal()->item(ScheduleAttendanceData::create($data), new ScheduleAttendanceDataTransformer);
        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
