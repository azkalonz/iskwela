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
    //classes
    Route::get('/classes', 'Api\\ClassController@index');
    Route::get('/class/{id}', 'Api\\ClassController@show');
    Route::post('/class/save', 'Api\\ClassController@save');
    Route::get('/class/attendance/{id}', 'Api\\ClassController@attendance');

    //uploads
    Route::post('/upload/activity/material', 'Api\\FileController@assignmentMaterial');
    Route::post('/upload/activity/answer', 'Api\\FileController@save'); //todo
    Route::post('/upload/class/lesson-plan', 'Api\\FileController@lessonPlan');
    Route::post('/upload/class/material', 'Api\\FileController@classMaterial');

    //downloads
    Route::post('/download/activity/material/{id}', 'Api\\FileController@downloadAssignmentMaterial');
    Route::post('/download/activity/answer', 'Api\\FileController@save'); //todo
    Route::post('/download/class/lesson-plan', 'Api\\FileController@downloadLessonPlan')
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
	Route::get('/student/classes', 'Api\\ClassController@studentClasses');
});