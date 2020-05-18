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

Route::post('/file/upload', 'Api\\FileController@upload');

Route::middleware('jwt')->group(function () {
    //classes
    Route::get('/classes', 'Api\\ClassController@index');
    Route::get('/class/{id}', 'Api\\ClassController@show');
    Route::post('/class/save', 'Api\\ClassController@save');
    Route::get('/class/attendance/{id}', 'Api\\ClassController@attendance');

    //schedules
    Route::post('/schedule/save', 'Api\\ScheduleController@save');
    Route::post('/schedule/{id}', 'Api\\ScheduleController@show');
});