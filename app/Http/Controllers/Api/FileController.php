<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Traits\File;
use App\Models\UserPreference;
use App\Models\Classes;
use App\Models\Assignment;
use Illuminate\Http\UploadedFile;

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
        'txt',
        'mpga', // mp3
        'wav',
        'ppt',
        'pptx',
        'mp4',
        'mkv',
        'avi',
        'wmv',
        'mov'
    ];
	
	const SUPPORTED_IMAGE_TYPES = [
        'jpeg',
        'bmp',
        'png',
        'gif'
    ];

    const SEATWORK = 1;
	const PROJECT = 2;
	const ASSIGNMENT = 3;

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/upload/seatwork/material Add Material (FILE)
    * @apiVersion 1.0.0
    * @apiName UploadSeatworkMaterial
    * @apiDescription Upload seatwork material/resource for student's reference
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    * @apiParam {String} title file title
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function seatworkMaterial(Request $request)
    {
        return $this->assignmentMaterial($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/upload/material Add Material (FILE)
    * @apiVersion 1.0.0
    * @apiName UploadFreestyleAssignmentMaterial
    * @apiDescription Upload assignment material/resource for student's reference
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    * @apiParam {String} title file title
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function addAssignmentMaterial(Request $request)
    {
        return $this->assignmentMaterial($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/upload/project/material Add Material (FILE)
    * @apiVersion 1.0.0
    * @apiName UploadProjectMaterial
    * @apiDescription Upload project material/resource for student's reference
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    * @apiParam {String} title file title
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function projectMaterial(Request $request)
    {
        return $this->assignmentMaterial($request, self::PROJECT);
    }

    public function assignmentMaterial(Request $request, int $activity_type)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'assignment_id' => 'integer',
            'title' => 'string'
        ]);

        $assignment = Assignment::whereId($request->assignment_id)->whereActivityType($activity_type)->firstOrFail();
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
    * Seatworks
    *
    * @api {POST} HOST/api/upload/seatwork/answer Upload Answer (For student)
    * @apiVersion 1.0.0
    * @apiName UploadSeatworkAnswer
    * @apiDescription Upload seatwork answer
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function seatworkAnswer(Request $request)
    {
        return $this->assignmentAnswer($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/upload/answer Upload Answer (For student)
    * @apiVersion 1.0.0
    * @apiName UploadFreeStyleAssignmentAnswer
    * @apiDescription Upload assignment answer
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function submitAssignmentAnswer(Request $request)
    {
        return $this->assignmentAnswer($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/upload/project/answer Upload Answer (For student)
    * @apiVersion 1.0.0
    * @apiName UploadProjectAnswer
    * @apiDescription Upload project answer
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
    * @apiParam {Number} assignment_id the activity id
    *
    * @apiSuccess {String=true,false} success
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function projectAnswer(Request $request)
    {
        return $this->assignmentAnswer($request, self::PROJECT);
    }

    public function assignmentAnswer(Request $request, $activity_type)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES),
            'assignment_id' => 'integer'
        ]);

        $seatwork = Assignment::whereId($request->assignment_id)->whereActivityType($activity_type)->firstOrFail();

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
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif} profile_picture The file to be uploaded
     *
     * @apiSuccess {String} url public URL of the profile picture
     * @apiSuccessExample {json} Sample Response
        {
            "url": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/jMoBdeY7IlWlqgKOHfmdnC6fls6iUiQjMYcjgEmK.jpeg"
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

        $path = $this->uploadToPublicSpace($request->profile_picture);
        
        if($path) {
            $url = $this->getFilePublicUrl($path);
            $user_preference = UserPreference::firstOrNew(['user_id' => $user->id]);
			$user_preference->profile_picture = $this->getFilePublicUrl($path);
			$user_preference->updated_by = $user->id;

			$user_preference->save();
        }
        else {
            return response('Unable to upload file', 500);
        }

        return response()->json(['url' => $url]);
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
            $path = $this->uploadToPublicSpace($request->image);

            if($path) {
                $url = $this->getFilePublicUrl($path);
                $class = Classes::find($request->id);
                $class->image = $url;
                $class->updated_by = $user->id;
                $class->save();
            }
            else {
                return response('Unable to upload file', 500);
            }
    
            return response()->json(['url' => $url]);
        }
        else{
            return response('Unable to upload file', 401);
        }
    }

    /*** DOWNLOAD: ***/

    /**
     * Download Activity Material
     *
     * @api {POST} HOST/api/download/activity/material/:id Activity Material
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
     * @api {POST} HOST/api/download/activity/answer/:id Activity Answer
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
     * @api {POST} HOST/api/download/class/material/:id Class Instruction Material
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
     * @api {POST} HOST/api/download/class/lesson-plan/:id Lesson Plan
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

    public function upload($file) : Array
    {
        $root_path = Auth::user()->school->school_code;
        $full_path = $this->uploadFile($file, $root_path);

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

    /**
     * Downloads the image from a given URL and upload to DO public space
     *
     * @api {POST} HOST/api/do/image/url Download Image from URL
     * @apiVersion 1.0.0
     * @apiName DownloadImageURL
     * @apiDescription Downloads the image from a given URL and upload to iSkwela's DO public space
     * @apiGroup File Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String} download_url URL of image to download
     *
     * @apiSuccess {String} url the URL of image in DO space
     *
    * @apiSuccessExample {json} Sample Response
        {
            "url": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/2HcfRWiuJHcKKWKms44q4w4zvVvhEwDWaUALju0A.jpeg"
        }
    *
     */

     public function imageUrlDownloadUpload(Request $request)
     {
        $request->validate([
            'download_url' => 'string|required'
        ]);

        // get the file info
        $info = pathinfo($request->download_url);

        // store the image locally
        $contents = file_get_contents($request->download_url);
        $file = sprintf("%s/%s", storage_path(),$info['basename']);
        file_put_contents($file, $contents);

        // generate the file object
        $uploaded_file = new UploadedFile($file, $info['basename']);

        // copy to DO space
        $path = $this->uploadToPublicSpace($uploaded_file);

        // remove the file locally to free space
        unlink($file);

        return response()->json(['url' => $this->getFilePublicUrl($path)]);
     }
}
