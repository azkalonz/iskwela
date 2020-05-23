<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Traits\File;

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
        'application/pdf',
        'application/doc',
        'text/plain',
		'txt'
    ];

    /**
     * Upload Assignment Material
     *
     * @api {POST} HOST/api/upload/activity/material Activity Material
     * @apiVersion 1.0.0
     * @apiName UploadActivityMaterial
     * @apiDescription Allows adding media to activity
     * @apiGroup Upload
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
            'assignment_id' => 'integer'
        ]);

        $response = $this->upload($request->file);

        if($response['success']) {
            $activity_material = new \App\Models\AssignmentMaterial();
            $activity_material->assignment_id = $request->assignment_id;
            $activity_material->file = $response['file'];
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
     * @apiGroup Upload
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

        if($response['success']) {
            $activity_answer = new \App\Models\AssignmentAnswer();
            $activity_answer->assignment_id = $request->assignment_id;
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
     * @apiGroup Upload
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
     * @apiGroup Upload
     *
     * @apiUse JWTHeader
     *
     * @apiParam {File=*.jpeg,*.bmp,*.png,*.gif, *.pdf, *.doc,*.txt} file The file to be uploaded
     * @apiParam {Number} schedule_id the schedule id
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
            'schedule_id' => 'integer'
        ]);
		
		$user =  Auth::user();

        $response = $this->upload($request->file);

        if($response['success']) {
            $lesson_plan = new \App\Models\LessonPlan();
            $lesson_plan->schedule_id = $request->schedule_id;
            $lesson_plan->file = $response['file'];
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
     * Download Activity Material
     *
     * @api {POST} HOST/api/download/activity/material/{id} Activity Material
     * @apiVersion 1.0.0
     * @apiName DownloadActivityMaterial
     * @apiDescription Downloads the activity material
     * @apiGroup Download
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
     * @apiGroup Download
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
        return $this->download($assignment_answer->file);
    }

    /**
     * Download Class Material
     *
     * @api {POST} HOST/api/download/class/material/{id} Class Instruction Material
     * @apiVersion 1.0.0
     * @apiName DownloadClassMaterial
     * @apiDescription Downloads the class material
     * @apiGroup Download
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id Class material ID
     *
     * @apiSuccess {BLOB} the attached file
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
     * @apiGroup Download
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

    public function download($filename)
    {
        return $this->downloadFile($filename);
    }

    public function upload($file) : Array
    {
        $full_path = $this->uploadFile($file);

        return [
            'success' => ($full_path) ? true : false,
            'file' => $full_path,
        ];
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
