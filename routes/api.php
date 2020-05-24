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

    //classes -students
    Route::get('/student/classes', 'Api\\ClassController@studentClasses');
    Route::get('/student/class/{id}', 'Api\\ClassController@showStudentClass');
    Route::get('/student/class-activities/{id}', 'Api\\ScheduleController@studentActivitiesBySchedule');
    Route::get('/student/class-schedules/{id}', 'Api\\ScheduleController@classStudentSchedules');
    Route::get('/student/class-materials/{id}', 'Api\\ScheduleController@classMaterialsStudentsBySchedule');



    Route::post('/class/save', 'Api\\ClassController@save');
    Route::get('/class/attendance/{id}', 'Api\\ClassController@attendance');

    //uploads
    Route::post('/upload/activity/material', 'Api\\FileController@assignmentMaterial');
    Route::post('/upload/activity/answer', 'Api\\FileController@assignmentAnswer');
    Route::post('/upload/class/lesson-plan', 'Api\\FileController@lessonPlan');
    Route::post('/upload/class/material', 'Api\\FileController@classMaterial');
    Route::post('/upload/user/profile-picture', 'Api\\FileController@userProfilePicture');

    //downloads
    Route::post('/download/activity/material/{id}', 'Api\\FileController@downloadAssignmentMaterial');
    Route::post('/download/activity/answer', 'Api\\FileController@downloadAssignmentAnswer');
    Route::post('/download/class/lesson-plan', 'Api\\FileController@downloadLessonPlan');
    Route::post('/download/class/material/{id}', 'Api\\FileController@downloadClassMaterial');

    //schedules
    Route::post('/schedule/save', 'Api\\ScheduleController@save');
    Route::post('/schedule/{id}', 'Api\\ScheduleController@show');

    //activities
    Route::post('/class/activity/save', 'Api\\AssignmentController@save');
    Route::post('/class/activity/publish/{id}', 'Api\\AssignmentController@publish');
    Route::get('/class/activity/{id}', 'Api\\AssignmentController@show');

	//student
	Route::post('/students/improvement/add', 'Api\\StudentController@addImprovement');
	Route::get('/students/improvement/', 'Api\\StudentController@studentImprovement');

	//users
	Route::get('/user', 'Api\\UserController@show');
	//Route::post('/user/change-password', 'Api\\UserController@changePassword');
	
	//lesson_plans
	Route::get('/class/lesson-plan/save', 'Api\\LessonPlanController@save');
	
});