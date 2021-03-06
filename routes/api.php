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

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('jwt')->group(function () {

    //jitsi auth
    Route::post('/auth/jitsi', 'AuthController@jitsiLogin');


    //classes - teachers
    Route::get('/teacher/classes', 'Api\\ClassController@teacherClasses');
    Route::get('/teacher/class/{id}', 'Api\\ClassController@show');
    Route::get('/teacher/class-students/{id}', 'Api\\ClassController@classStudentList');
    Route::get('/teacher/class-schedules/{id}', 'Api\\ScheduleController@classTeacherSchedules');
    Route::get('/teacher/class-seatworks/{id}', 'Api\\ScheduleController@studentSeatworksBySchedule');
    Route::get('/teacher/class-projects/{id}', 'Api\\ScheduleController@studentProjectsBySchedule');
    Route::get('/teacher/class-lesson-plans/{id}', 'Api\\ScheduleController@lessonPlansBySchedule');
    Route::get('/teacher/class-materials/{id}', 'Api\\ScheduleController@classMaterialsTeachersBySchedule');
    Route::get('/teacher/remove/class/{id}', 'Api\\ClassController@removeClass');
    Route::post('/teacher/remove/class-lesson-plan/{id}', 'Api\\LessonPlanController@remove');
    Route::post('/teacher/remove/class-material/{id}', 'Api\\ClassController@removeClassMaterial');
    Route::post('/teacher/remove/class-seatwork-material/{id}', 'Api\\AssignmentController@removeSeatworkMaterial');
    Route::post('/teacher/remove/class-seatwork/{id}', 'Api\\AssignmentController@removeSeatwork');
    Route::get('/teacher/seatwork-answers/{id}', 'Api\\AssignmentAnswerController@showSeatworkAnswer');
    Route::post('/teacher/remove/class-project-material/{id}', 'Api\\AssignmentController@removeProjectMaterial');
    Route::post('/teacher/remove/class-project/{id}', 'Api\\AssignmentController@removeProject');
    Route::get('/teacher/project-answers/{id}', 'Api\\AssignmentAnswerController@showProjectAnswer');


    //classes -students
    Route::get('/student/classes', 'Api\\ClassController@studentClasses');
    Route::get('/student/class/{id}', 'Api\\ClassController@showStudentClass');
    Route::get('/student/class-seatworks/{id}', 'Api\\ScheduleController@studentSeatworksBySchedule');
    Route::get('/student/class-projects/{id}', 'Api\\ScheduleController@studentProjectsBySchedule');
    Route::get('/student/class-schedules/{id}', 'Api\\ScheduleController@classStudentSchedules');
    Route::get('/student/class-materials/{id}', 'Api\\ScheduleController@classMaterialsStudentsBySchedule');
    Route::post('/class/attendance/save', 'Api\\AttendanceController@record');
    Route::get('/class/attendance/{id}', 'Api\\AttendanceController@attendance');
    Route::get('/class/my-attendance/', 'Api\\AttendanceController@details');
    Route::get('/class/schedule-attendance/', 'Api\\AttendanceController@scheduleAttendance');
    Route::get('/student/seatwork-answers/{id}', 'Api\\AssignmentAnswerController@showSeatworkAnswer');
    Route::get('/student/project-answers/{id}', 'Api\\AssignmentAnswerController@showProjectAnswer');

    // todo
    //Route::post('/class/save', 'Api\\ClassController@save');

    //uploads
    Route::post('/upload/seatwork/material', 'Api\\FileController@seatworkMaterial');
    Route::post('/upload/project/material', 'Api\\FileController@projectMaterial');
    Route::post('/upload/seatwork/answer', 'Api\\FileController@seatworkAnswer');
    Route::post('/upload/project/answer', 'Api\\FileController@projectAnswer');
    Route::post('/upload/class/lesson-plan', 'Api\\FileController@lessonPlan');
    Route::post('/upload/class/material', 'Api\\FileController@classMaterial');
    Route::post('/upload/user/profile-picture', 'Api\\FileController@userProfilePicture');
    Route::post('/upload/class/image/{id}', 'Api\\FileController@saveClassImage');

    //downloads
    Route::post('/download/activity/material/{id}', 'Api\\FileController@downloadAssignmentMaterial');
    Route::post('/download/activity/answer/{id}', 'Api\\FileController@downloadAssignmentAnswer');
    Route::post('/download/class/lesson-plan/{id}', 'Api\\FileController@downloadLessonPlan');
    Route::post('/download/class/material/{id}', 'Api\\FileController@downloadClassMaterial');
    //Route::post('/download/user/profile-picture', 'Api\\FileController@downloadProfilePicture');
    Route::post('/download/class/image/{id}', 'Api\\FileController@downloadClassImage');

    //schedules
    Route::post('/schedule/save', 'Api\\ScheduleController@save');
    Route::get('/schedule/{id}', 'Api\\ScheduleController@show');

    //Seatworks
    Route::post('/class/seatwork/save', 'Api\\AssignmentController@addSeatwork');
    Route::post('/class/seatwork/publish/{id}', 'Api\\AssignmentController@publishSeatwork');
    Route::get('/class/seatwork/{id}', 'Api\\AssignmentController@showSeatwork');
    Route::post('/class/seatwork-material/save', 'Api\\AssignmentController@saveSeatworkMaterial');
    Route::post('/class/seatwork/mark-done/{id}', 'Api\\AssignmentController@markSeatworkDone');
    Route::post('/class/seatwork/mark-not-done/{id}', 'Api\\AssignmentController@markSeatworkNotDone');
    Route::post('/class/seatwork/set-score', 'Api\\StudentActivityScoreController@setSeatworkScore');
    Route::get('/class/seatwork/get-score/{id}', 'Api\\StudentActivityScoreController@showSeatworkScore');

    //Projects
    Route::post('/class/project/save', 'Api\\AssignmentController@addProject');
    Route::post('/class/project/publish/{id}', 'Api\\AssignmentController@publishProject');
    Route::get('/class/project/{id}', 'Api\\AssignmentController@showProject');
    Route::post('/class/project-material/save', 'Api\\AssignmentController@saveProjectMaterial');
    Route::post('/class/project/mark-done/{id}', 'Api\\AssignmentController@markProjectDone');
    Route::post('/class/project/mark-not-done/{id}', 'Api\\AssignmentController@markProjectNotDone');
    Route::post('/class/project/set-score', 'Api\\StudentActivityScoreController@setProjectScore');
    Route::get('/class/project/get-score/{id}', 'Api\\StudentActivityScoreController@showProjectScore');

	//student
	Route::post('/students/improvement/save', 'Api\\StudentController@addImprovement');
	Route::get('/students/improvement/', 'Api\\StudentController@studentImprovement');

	//users
	Route::get('/user', 'Api\\UserController@show');
	Route::post('/user/change-password', 'AuthController@changePassword');
	
	//lesson_plans
    Route::post('/class/lesson-plan/save', 'Api\\LessonPlanController@save');
    Route::post('/class/lesson-plan/mark-done/{id}', 'Api\\LessonPlanController@markDone');
    Route::post('/class/lesson-plan/mark-not-done/{id}', 'Api\\LessonPlanController@markNotDone');

    //class material
    Route::post('/class/material/publish/{id}', 'Api\\ClassMaterialController@publish');
    Route::post('/class/material/unpublish/{id}', 'Api\\ClassMaterialController@unpublish');
    Route::post('/class/class-material/mark-done/{id}', 'Api\\ClassMaterialController@markDone');
    Route::post('/class/class-material/mark-not-done/{id}', 'Api\\ClassMaterialController@markNotDone');
    Route::post('/class/material/save', 'Api\\ClassMaterialController@save');

    //upload to public
    Route::post('/public/upload', 'Api\\FileController@publicUpload');

    //questionnaire
    Route::post('/questionnaire/save', 'Api\\QuestionnaireController@save');
    Route::get('/questionnaires', 'Api\\QuestionnaireController@questionnaires');
    Route::post('/questionnaire/school-publish/{id}', 'Api\\QuestionnaireController@schoolPublish');
    Route::delete('/questionnaire/delete/{id}', 'Api\\QuestionnaireController@deleteQuestionnaire');
    Route::get('/questionnaire/{id}', 'Api\\QuestionnaireController@show');

    //quizzes
    Route::post('/quiz/save', 'Api\\StudentActivityController@saveQuiz');
    Route::get('/quizzes', 'Api\\StudentActivityController@quizzes');
    Route::get('/quiz/{id}', 'Api\\StudentActivityController@getQuiz');
    Route::post('/quiz/publish', 'Api\\StudentActivityController@publishQuiz');
    Route::post('/quiz/unpublish', 'Api\\StudentActivityController@unpublishQuiz');
    Route::delete('/quiz/delete/{id}', 'Api\\StudentActivityController@deleteQuiz');
    Route::post('/quiz/questionnaire/add', 'Api\\StudentActivityController@addQuizQuestionnaire');
    Route::post('/quiz/questionnaire/remove', 'Api\\StudentActivityController@removeQuizQuestionnaire');
    Route::post('/quiz/close/{id}', 'Api\\StudentActivityController@closeQuiz');

    // periodical
    Route::post('/periodical/save', 'Api\\StudentActivityController@savePeriodical');
    Route::get('/periodicals', 'Api\\StudentActivityController@periodicals');
    Route::get('/periodical/{id}', 'Api\\StudentActivityController@getPeriodical');
    Route::post('/periodical/publish', 'Api\\StudentActivityController@publishPeriodical');
    Route::post('/periodical/unpublish', 'Api\\StudentActivityController@unpublishPeriodical');
    Route::delete('/periodical/delete/{id}', 'Api\\StudentActivityController@deletePeriodical');
    Route::post('/periodical/questionnaire/add', 'Api\\StudentActivityController@addPeriodicalQuestionnaire');
    Route::post('/periodical/questionnaire/remove', 'Api\\StudentActivityController@removePeriodicalQuestionnaire');
    Route::post('/periodical/close/{id}', 'Api\\StudentActivityController@closePeriodical');

    // assignment
    Route::post('/assignment/save', 'Api\\StudentActivityController@saveAssignment');
    Route::get('/assignments', 'Api\\StudentActivityController@assignments');
    Route::get('/assignment/{id}', 'Api\\StudentActivityController@getAssignment');
    Route::post('/assignment/publish', 'Api\\StudentActivityController@publishAssignment');
    Route::post('/assignment/unpublish', 'Api\\StudentActivityController@unpublishAssignment');
    Route::delete('/assignment/delete/{id}', 'Api\\StudentActivityController@deleteAssignment');
    Route::post('/assignment/questionnaire/add', 'Api\\StudentActivityController@addAssignmentQuestionnaire');
    Route::post('/assignment/questionnaire/remove', 'Api\\StudentActivityController@removeAssignmentQuestionnaire');
    Route::post('/assignment/close/{id}', 'Api\\StudentActivityController@closeAssignment');

    /** FREE-STYLE ASSIGNMENT */
    //common
    Route::get('/assignments/v2/{id}', 'Api\\ScheduleController@assignmentsBySchedule');
    Route::get('/assignment/v2/{id}', 'Api\\AssignmentController@showAssignment');
    Route::get('/assignment/v2/get-score/{id}', 'Api\\StudentActivityScoreController@showAssignmentScore');
    Route::get('/assignment/v2/view-answers/{id}', 'Api\\AssignmentAnswerController@showAssigmentAnswer');
    // for teachers
    Route::post('/assignment/v2/save', 'Api\\AssignmentController@addAssignment');
    Route::post('/assignment/v2/publish/{id}', 'Api\\AssignmentController@publishAssignment');
    Route::post('/assignment/v2/material/save', 'Api\\AssignmentController@saveAssignmentMaterial');
    Route::post('/assignment/v2/mark-done/{id}', 'Api\\AssignmentController@markAssignmentDone');
    Route::post('/assignment/v2/mark-not-done/{id}', 'Api\\AssignmentController@markAssignmentNotDone');
    Route::post('/assignment/v2/set-score', 'Api\\StudentActivityScoreController@setAssignmentScore');
    Route::post('/assignment/v2/upload/material', 'Api\\FileController@addAssignmentMaterial');
    Route::post('/assignment/v2/remove/material/{id}', 'Api\\AssignmentController@removeFreeStyleAssignmentMaterial');
    Route::post('/assignment/v2/remove/{id}', 'Api\\AssignmentController@removeFreeStyleAssignment');
    //for students
    Route::post('/assignment/v2/upload/answer', 'Api\\FileController@submitAssignmentAnswer');

    /** END FREE-STYLE ASSIGNMENT */

    // student submission
    Route::post('/quiz/answer/submit', 'Api\\StudentActivityAnswerController@submitQuizAnswer');
    Route::post('/periodical/answer/submit', 'Api\\StudentActivityAnswerController@submitPeriodicalAnswer');
    Route::post('/assignment/answer/submit', 'Api\\StudentActivityAnswerController@submitAssignmentAnswer');
    Route::post('/quiz/complete/{id}', 'Api\\StudentActivityController@completeQuiz');
    Route::post('/assignment/complete/{id}', 'Api\\StudentActivityController@completeAssignment');
    Route::post('/periodical/complete/{id}', 'Api\\StudentActivityController@completePeriodical');


    //SchoolAdmin
    Route::post('/schooladmin/school-grading-category/save', 'Api\\SchoolGradingCategoryController@save');
    Route::post('/schooladmin/subject-grading-category/save', 'Api\\SubjectGradingCategoryController@save');
    Route::delete('/schooladmin/school-grading-category/remove/{id}', 'Api\\SchoolGradingCategoryController@remove');
    Route::delete('/schooladmin/subject-grading-category/remove/{id}', 'Api\\SubjectGradingCategoryController@remove');
    Route::get('/schooladmin/school-grading-categories', 'Api\\SchoolGradingCategoryController@show');
    Route::get('/schooladmin/subject-grading-categories/{id}', 'Api\\SubjectGradingCategoryController@show');
    Route::get('/schooladmin/teachers', 'Api\\SchoolController@teachers');
    Route::delete('/schooladmin/parent/remove-child', 'Api\\StudentParentController@remove');
    Route::post('/schooladmin/parent/add-child', 'Api\\StudentParentController@save');
    Route::get('/parent/show', 'Api\\StudentParentController@show');

    Route::post('/admin/register/parent', 'Api\\UserController@registerParent');
    Route::post('/admin/register/student', 'Api\\UserController@registerStudent');
    Route::post('/admin/register/teacher', 'Api\\UserController@registerTeacher');
    Route::post('/admin/register/admin', 'Api\\UserController@registerAdmin');
    Route::post('/admin/register/super-admin', 'Api\\UserController@registerSuperAdmin');
    Route::post('/admin/user/deactivate/{id}', 'Api\\UserController@deactivate');
    Route::post('/admin/user/activate/{id}', 'Api\\UserController@activate');

    Route::post('/admin/user/update/{id}', 'Api\\UserController@updateUser');

    //reports
    Route::get('/reports/activity-scores', 'Api\\ReportController@activities');
    Route::get('/reports/quizzes', 'Api\\ReportController@quizzes');
    Route::get('/reports/periodicals', 'Api\\ReportController@periodicals');
    Route::get('/reports/assignments', 'Api\\ReportController@assignments');
    Route::get('/reports/seatworks', 'Api\\ReportController@seatworks');
    Route::get('/reports/projects', 'Api\\ReportController@projects');

    //school admin user settings
    Route::post('/schooladmin/change-user-password', 'AuthController@adminChangePassword');
    Route::post('/schooladmin/class/save', 'Api\\ClassController@saveClass');
    Route::delete('/schooladmin/class/remove/{id}', 'Api\\ClassController@adminRemoveClass');
    Route::post('/schooladmin/section/add-student', 'Api\\SectionStudentController@add');
    Route::delete('/schooladmin/section/remove-student/', 'Api\\SectionStudentController@remove');
    Route::get('/schooladmin/students', 'Api\\UserController@students');
    Route::get('/schooladmin/parents', 'Api\\UserController@parents');

    Route::get('/schooladmin/sections', 'Api\\SectionController@show');
    Route::post('/schooladmin/section/save', 'Api\\SectionController@save');
    Route::delete('/schooladmin/section/remove/{id}', 'Api\\SectionController@remove');
    Route::get('/years', 'Api\\YearController@show');
    Route::get('/subjects', 'Api\\SubjectController@show');
    Route::get('/schooladmin/classes', 'Api\\ClassController@adminClasses');

    // posts and comments
    Route::get('/post/{itemable_type}/{itemable_id}', 'Api\\PostController@getPostsOfItemable');
    Route::get('/post/{id}', 'Api\\PostController@show');
    Route::delete('/post/remove/{id}', 'Api\\PostController@remove');
    Route::post('/post/save', 'Api\\PostController@save');
    Route::get('/comment/{id}', 'Api\\CommentController@show');
    Route::delete('/comment/remove/{id}', 'Api\\CommentController@remove');
    Route::post('/comment/save', 'Api\\CommentController@save');


    Route::post('/do/image/url', 'Api\\FileController@imageUrlDownloadUpload');

    Route::get('/activity/scores', 'Api\\StudentActivityAnswerController@getStudentScores');
    Route::get('/activity/attempts', 'Api\\StudentActivityAnswerController@getAttempts');
    Route::get('/activity/attempt/show', 'Api\\StudentActivityAnswerController@showAttempt');

});