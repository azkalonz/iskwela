<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/school/import', 'Api\\SchoolDataController@import');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('jwt')->group(function () {
    //classes - teachers
    Route::get('/teacher/classes', 'Api\\ClassController@teacherClasses');
    Route::get('/teacher/class/{id}', 'Api\\ClassController@show');
    Route::get('/teacher/class-students/{id}', 'Api\\ClassController@classStudentList');
    Route::get('/teacher/class-schedules/{id}', 'Api\\ScheduleController@classTeacherSchedules');
    Route::get('/teacher/class-activities/{id}', 'Api\\ScheduleController@activitiesBySchedule');
    Route::get('/teacher/class-lesson-plans/{id}', 'Api\\ScheduleController@lessonPlansBySchedule');
    Route::get('/teacher/class-materials/{id}', 'Api\\ScheduleController@classMaterialsTeachersBySchedule');
    Route::post('/teacher/remove/class-lesson-plan/{id}', 'Api\\LessonPlanController@remove');
    Route::post('/teacher/remove/class-material/{id}', 'Api\\ClassController@removeClassMaterial');
    Route::post('/teacher/remove/class-activity-material/{id}', 'Api\\AssignmentController@removeAssignmentMaterial');
    Route::post('/teacher/remove/class-activity/{id}', 'Api\\AssignmentController@remove');
    Route::post('/class/material/save', 'Api\\ClassController@saveClassMaterial');


    //classes -students
    Route::get('/student/classes', 'Api\\ClassController@studentClasses');
    Route::get('/student/class/{id}', 'Api\\ClassController@showStudentClass');
    Route::get('/student/class-activities/{id}', 'Api\\ScheduleController@studentActivitiesBySchedule');
    Route::get('/student/class-schedules/{id}', 'Api\\ScheduleController@classStudentSchedules');
    Route::get('/student/class-materials/{id}', 'Api\\ScheduleController@classMaterialsStudentsBySchedule');
    Route::post('/class/attendance/save', 'Api\\AttendanceController@record');
    Route::get('/class/attendance/{id}', 'Api\\AttendanceController@attendance');
    Route::get('/student/activity-answers/{id}', 'Api\\AssignmentAnswerController@show');

    // todo
    Route::post('/class/save', 'Api\\ClassController@save');

    //uploads
    Route::post('/upload/activity/material', 'Api\\FileController@assignmentMaterial');
    Route::post('/upload/activity/answer', 'Api\\FileController@assignmentAnswer');
    Route::post('/upload/class/lesson-plan', 'Api\\FileController@lessonPlan');
    Route::post('/upload/class/material', 'Api\\FileController@classMaterial');
    Route::post('/upload/user/profile-picture', 'Api\\FileController@userProfilePicture');

    //downloads
    Route::post('/download/activity/material/{id}', 'Api\\FileController@downloadAssignmentMaterial');
    Route::post('/download/activity/answer/{id}', 'Api\\FileController@downloadAssignmentAnswer');
    Route::post('/download/class/lesson-plan/{id}', 'Api\\FileController@downloadLessonPlan');
    Route::post('/download/class/material/{id}', 'Api\\FileController@downloadClassMaterial');
    Route::post('/download/user/profile-picture', 'Api\\FileController@downloadProfilePicture');

    //schedules
    Route::post('/schedule/save', 'Api\\ScheduleController@save');
    Route::get('/schedule/{id}', 'Api\\ScheduleController@show');

    //activities
    Route::post('/class/activity/save', 'Api\\AssignmentController@save');
    Route::post('/class/activity/publish/{id}', 'Api\\AssignmentController@publish');
    Route::get('/class/activity/{id}', 'Api\\AssignmentController@show');
    Route::post('/class/activity-material/save', 'Api\\AssignmentController@saveActivityMaterial');

	//student
	Route::post('/students/improvement/save', 'Api\\StudentController@addImprovement');
	Route::get('/students/improvement/', 'Api\\StudentController@studentImprovement');

	//users
	Route::get('/user', 'Api\\UserController@show');
	Route::post('/user/change-password', 'AuthController@changePassword');
	
	//lesson_plans
    Route::post('/class/lesson-plan/save', 'Api\\LessonPlanController@save');
});