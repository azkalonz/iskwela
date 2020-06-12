<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Traits\File;
use App\Models\UserPreference;
use App\Models\Classes;

use Storage;
use Auth;

class FileController extends Controller
{
    use File;

    const SUPPORTED_TYPES = [
        'jpeg',
        'bmp',
        'png',
        'gif',
        'pdf',
        'doc',
        'docx',
        'txt'
    ];
	
	const SUPPORTED_IMAGE_TYPES = [
        'jpeg',
        'bmp',
        'png',
        'gif'
    ];

    /**
     * Upload Assignment Material
     *
     * @api {POST} HOST/api/upload/activity/material Activity Material
     * @apiVersion 1.0.0
     * @apiName UploadActivityMaterial
     * @apiDescription Allows adding media to activity
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
     * @apiParam {Number} assignment_id the activity id
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */

    public function assignmentMaterial(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'assignment_id' => 'integer',
            'title' => 'string'
        ]);

        $response = $this->upload($request->file);

        if($response['success']) {
            $activity_material = new \App\Models\AssignmentMaterial();
            $activity_material->assignment_id = $request->assignment_id;
            $activity_material->file = $response['file'];
            $activity_material->title = $request->title;
            $activity_material->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['success' => $response['success']]);
    }
	
	/**
     * Upload Activity Answer
     *
     * @api {POST} HOST/api/upload/activity/answer
     * @apiVersion 1.0.0
     * @apiName UploadActivityAnswer
     * @apiDescription Allows adding answers to activity
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
     * @apiParam {Number} assignment_id the activity id
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */

    public function assignmentAnswer(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'assignment_id' => 'integer'
        ]);

        $response = $this->upload($request->file);

        $user = Auth::user();
        if($response['success']) {
            $activity_answer = new \App\Models\AssignmentAnswer();
            $activity_answer->assignment_id = $request->assignment_id;
            $activity_answer->student_id = $user->getKey();
            $activity_answer->answer_media = $response['file'];
            $activity_answer->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['success' => $response['success']]);
    }

    /**
     * Upload Class Material
     *
     * @api {POST} HOST/api/upload/class/material Class Instruction Material
     * @apiVersion 1.0.0
     * @apiName UploadClassMaterial
     * @apiDescription Allows adding class instruction materials
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
     * @apiParam {Number} class_id 
     * @apiParam {Number} schedule_id The session ID
     * @apiParam {String} title File title
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */
    public function classMaterial(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'schedule_id' => 'integer|required',
            'class_id' => 'integer|required',
            'title' => 'string'
        ]);

        $user =  Auth::user();
        $response = $this->upload($request->file);

        if($response['success']) {
            $clas_material = new \App\Models\ClassMaterial();
            $clas_material->title = $request->title;
            $clas_material->filename = $response['file'];
            $clas_material->class_id = $request->class_id;
            $clas_material->schedule_id = $request->schedule_id;
            $clas_material->created_by = $user->id;
            $clas_material->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['success' => $response['success']]);
    }
	
	/**
     * Upload Class Lesson Plan
     *
     * @api {POST} HOST/api/upload/class/lesson_plan Class Lesson Plan
     * @apiVersion 1.0.0
     * @apiName UploadClassLessonPlan
     * @apiDescription Allows adding media to lesson plan
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
     * @apiParam {Number} schedule_id the schedule id
     * @apiParam {String} title title of the Lesson Plan
     * @apiParam {Number} class_id the class ID
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */

    public function lessonPlan(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'schedule_id' => 'integer|required',
			'title' => 'required|string',
			'class_id' => 'required|integer',
        ]);
		
		$user =  Auth::user();

        $response = $this->upload($request->file);

        if($response['success']) {
            $lesson_plan = new \App\Models\LessonPlan();
            $lesson_plan->schedule_id = $request->schedule_id;
            $lesson_plan->file = $response['file'];
            $lesson_plan->title = $request['title'];
            $lesson_plan->class_id = $request['class_id'];
			$lesson_plan->created_by = $user->id;
			$lesson_plan->updated_by = $user->id;
            $lesson_plan->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['success' => $response['success']]);
    }
	
	
	/**
     * Upload User Profile Picture
     *
     * @api {POST} HOST/api/upload/user/profile-picture Upload Profile Picture
     * @apiVersion 1.0.0
     * @apiName UploadUserProfilePicture
     * @apiDescription Allows users to upload/change profile picture
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif} file The file to be uploaded
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */

    public function userProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|file|mimes:' . implode(',', self::SUPPORTED_IMAGE_TYPES)
        ]);

		$user =  Auth::user();

        $response = $this->upload($request->profile_picture);

        if($response['success']) {
            $user_preference = UserPreference::firstOrNew(['user_id' => $user->id]);
			$user_preference->profile_picture = $response['file'];
			$user_preference->updated_by = $user->id;

			$user_preference->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['success' => $response['success']]);
    }


    /**
     * Upload Class Image
     *
     * @api {POST} HOST/api/upload/class/image Upload Class Image
     * @apiVersion 1.0.0
     * @apiName UploadClassImage
     * @apiDescription Add or Edit a class image
     * @apiGroup File Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif} file The file to be uploaded
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */

    public function saveClassImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:' . implode(',', self::SUPPORTED_IMAGE_TYPES)
        ]);

        $user =  Auth::user();

        if($user->type = 't')
        {
            $response = $this->upload($request->image);

            if($response['success']) {
                $class = Classes::find($request->id);
                $class->image = $response['file'];
                $class->updated_by = $user->id;
                $class->save();
            }
            else {
                return response('Unable to upload file', 500);
            }
    
            return response()->json(['success' => $response['success']]);
        }
        else{
            return response('Unable to upload file', 401);
        }
        
    }

    /*** DOWNLOAD: ***/

    /**
     * Download Activity Material
     *
     * @api {POST} HOST/api/download/activity/material/{id} Activity Material
     * @apiVersion 1.0.0
     * @apiName DownloadActivityMaterial
     * @apiDescription Downloads the activity material
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Activity material ID
     *
     * @apiSuccess {BLOB} the attached file
     *
     */
    public function downloadAssignmentMaterial(Request $request)
    {
        $user =  Auth::user();

        if(!$user) {
            return response('Unauthorized access', 401);
        }

        $assignment_material = \App\Models\AssignmentMaterial::find($request->id);
        return $this->download($assignment_material->file);
    }
	
	/**
     * Download Activity Answer
     *
     * @api {POST} HOST/api/download/activity/answer/{id} Activity Answer
     * @apiVersion 1.0.0
     * @apiName DownloadActivityAnswer
     * @apiDescription Downloads the activity answer
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Activity answer ID
     *
     * @apiSuccess {BLOB} the attached file
     *
     */
    public function downloadAssignmentAnswer(Request $request)
    {
        $user =  Auth::user();

        if(!$user) {
            return response('Unauthorized access', 401);
        }

        $assignment_answer = \App\Models\AssignmentAnswer::find($request->id);
        return $this->download($assignment_answer->answer_media);
    }

    /**
     * Download Class Material
     *
     * @api {POST} HOST/api/download/class/material/{id} Class Instruction Material
     * @apiVersion 1.0.0
     * @apiName DownloadClassMaterial
     * @apiDescription Downloads the class material
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Class material ID
     *
     * @apiSuccess {BLOB} file the attached file
     *
     */
    public function downloadClassMaterial(Request $request)
    {
        $user =  Auth::user();

        if(!$user) {
            return response('Unauthorized access', 401);
        }

        $class_material = \App\Models\ClassMaterial::find($request->id);
        return $this->download($class_material->filename);
    }

    /**
     * Download Lessson Plan
     *
     * @api {POST} HOST/api/download/class/lesson-plan/{id} Lesson Plan
     * @apiVersion 1.0.0
     * @apiName DownloadLessonPlan
     * @apiDescription Downloads the lesson plan
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Lesson Plan ID
     *
     * @apiSuccess {BLOB} the attached file
     *
     */
    public function downloadLessonPlan(Request $request)
    {
        $user =  Auth::user();

        if(!$user) {
            return response('Unauthorized access', 401);
        }

        $lesson_plan = \App\Models\LessonPlan::find($request->id);
        return $this->download($lesson_plan->file);
    }

    /**
     * Download Profile Picture
     *
     * @api {POST} HOST/api/download/user/profile-picture Profile Picture
     * @apiVersion 1.0.0
     * @apiName DownloadProfilePicture
     * @apiDescription Returns the url of auth user's profile picture
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id User ID
     *
     * @apiSuccess {BLOB} file the attached file. Returns 404 if not found.
     *
     */
    public function downloadProfilePicture(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);

        $user = Auth::user();

        if($request->id){
            $user = \App\Models\User::find($request->id);
        }

        if(!$user) {
            return response('No Auth user', 401);
        }

        $user_pref = \App\Models\UserPreference::whereUserId($user->getKey())->first();
        if($user_pref){
            return $this->download($user_pref->profile_picture);
        }

        return response('Not Found', 404);
        
    }

    /**
     * Download Class Image
     *
     * @api {POST} HOST/api/download/class/image Download Class Image
     * @apiVersion 1.0.0
     * @apiName DownloadClassImage
     * @apiDescription Download class image 
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Class ID
     *
     * @apiSuccess {BLOB} file the attached file. Returns 404 if not found.
     *
     */
    public function downloadClassImage(Request $request)
    {

        $class = Classes::find($request->id);

        if($class)
        {
            return $this->download($class->image);
        }
        else
        {
            return response('Not Found', 404);
        }
    }    

    public function download($filename)
    {
        return $this->downloadFile($filename);
    }

    public function testUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES)
        ]);

        $response = $this->upload($request->file);

        return response()->json(['success' => $response['success']]);
    }

    public function testPublic() 
    {
        dd(Storage::disk('do_public')->url("SCHOOL01/2020-06-12/184425-image1c.jpeg"));
    }

    public function upload($file) : Array
    {
        $full_path = $this->uploadFile($file);

        return [
            'success' => ($full_path) ? true : false,
            'file' => $full_path,
        ];
    }

    public function publicUpload(Request $request)
    {
        $path = $this->uploadToPublicSpace($request->file);

        return response()->json(['url' => $this->getFilePublicUrl($path)]);
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
