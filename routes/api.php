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

    // periodical
    Route::post('/periodical/save', 'Api\\StudentActivityController@savePeriodical');
    Route::get('/periodicals', 'Api\\StudentActivityController@periodicals');
    Route::get('/periodical/{id}', 'Api\\StudentActivityController@getPeriodical');
    Route::post('/periodical/publish', 'Api\\StudentActivityController@publishPeriodical');
    Route::post('/periodical/unpublish', 'Api\\StudentActivityController@unpublishPeriodical');
    Route::delete('/periodical/delete/{id}', 'Api\\StudentActivityController@deletePeriodical');
    Route::post('/periodical/questionnaire/add', 'Api\\StudentActivityController@addPeriodicalQuestionnaire');
    Route::post('/periodical/questionnaire/remove', 'Api\\StudentActivityController@removePeriodicalQuestionnaire');

    // assignment
    Route::post('/assignment/save', 'Api\\StudentActivityController@saveAssignment');
    Route::get('/assignments', 'Api\\StudentActivityController@assignments');
    Route::get('/assignment/{id}', 'Api\\StudentActivityController@getAssignment');
    Route::post('/assignment/publish', 'Api\\StudentActivityController@publishAssignment');
    Route::post('/assignment/unpublish', 'Api\\StudentActivityController@unpublishAssignment');
    Route::delete('/assignment/delete/{id}', 'Api\\StudentActivityController@deleteAssignment');
    Route::post('/assignment/questionnaire/add', 'Api\\StudentActivityController@addAssignmentQuestionnaire');
    Route::post('/assignment/questionnaire/remove', 'Api\\StudentActivityController@removeAssignmentQuestionnaire');

    // student submission
    Route::post('/quiz/answer/submit', 'Api\\StudentActivityAnswerController@submitQuizAnswer');
    Route::post('/periodical/answer/submit', 'Api\\StudentActivityAnswerController@submitPeriodicalAnswer');
    Route::post('/assignment/answer/submit', 'Api\\StudentActivityAnswerController@submitAssignmentAnswer');


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
    Route::post('/schooladmin/section/add-student', 'Api\\SectionStudentController@add');
    Route::get('/schooladmin/students', 'Api\\UserController@students');

    Route::get('/schooladmin/sections', 'Api\\SectionController@show');
    Route::post('/schooladmin/section/save', 'Api\\SectionController@add');
    Route::delete('/schooladmin/section/remove/{id}', 'Api\\SectionController@remove');
    Route::get('/years', 'Api\\YearController@show');

    // posts and comments
    Route::get('/post/{itemable_type}/{itemable_id}', 'Api\\PostController@getPostsOfItemable');
    Route::get('/post/{id}', 'Api\\PostController@show');
    Route::delete('/post/remove/{id}', 'Api\\PostController@remove');
    Route::post('/post/save', 'Api\\PostController@save');
    Route::get('/comment/{id}', 'Api\\CommentController@show');
    Route::delete('/comment/remove/{id}', 'Api\\CommentController@remove');
    Route::post('/comment/save', 'Api\\CommentController@save');
});