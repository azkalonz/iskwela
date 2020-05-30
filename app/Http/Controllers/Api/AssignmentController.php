<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\Assignment;
use \App\Models\AssignmentAnswer;
use \App\Models\AssignmentMaterial;
use \App\Transformers\AssignmentTransformer;
use \App\Transformers\AssignmentMaterialTransformer;

class AssignmentController extends Controller
{

    /**
     * Add Activity
     *
     * @api {post} HOST/api/class/activity/save Add/Edit Activity
     * @apiVersion 1.0.0
     * @apiName AddActivity
     * @apiDescription Save class activity and returns the activity details
     * @apiGroup Activity
     *
     * @apiParam {Number} id Activity ID. If specified, edits the existing activity, otherwise, creates a new record
     * @apiParam {String} title
     * @apiParam {String} description
     * @apiParam {Number=1,2} activity_type 1-class activity, 2-assignment
     * @apiParam {Date=YYYY-mm-dd} available_from If set as assignment, can be null if session activity
     * @apiParam {Date=YYYY-mm-dd} available_to If set as assignment, can be null if session activity
     * @apiParam {Number=0,1} published 0-cannot be viewed by student, 1-publish to student
     * @apiParam {Number} subject_id
     * @apiParam {Number} schedule_id ID of session to which the activity will be attached
     * @apiParam {Number} class_id Class ID to which the activity will be attached
     *
     * @apiSuccess {Number} id Activity ID. The activity ID
     * @apiSuccess {String} title
     * @apiSuccess {String} description
     * @apiSuccess {String} activity_type class activity or assignment
     * @apiSuccess {Date} available_from
     * @apiSuccess {Date} available_to
     * @apiSuccess {String} status published/unpublished 
     * @apiSuccess {Array} materials
     * @apiSuccess {Number} materials.id any uploaded materials
     * @apiSuccess {String} materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} materials.resource_link Link to materials e.g google doc, website,etc
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 6,
            "title": "class activity sample edited",
            "instruction": "this is a class activity",
            "activity_type": "class activity",
            "available_from": null,
            "available_to": null,
            "status": "published",
            "materials": [
                {
                    "id": 4,
                    "uploaded_file": "SCHOOL01/2020-05-21/121026-bargram.png",
                    "resource_link": null
                }
            ]
        }
     *
     * 
     * 
     */
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'activity_type' => 'integer|required',
            'published' => 'integer|required',
            'subject_id' => 'integer|required',
            'schedule_id' => 'integer|required',
            'class_id' => 'integer|required',
        ]);

        $user =  Auth::user();

        $activity = Assignment::findOrNew($request->id);
        $activity->title = $request->title;
        $activity->instruction = $request->description;
        $activity->class_id = $request->class_id;
        $activity->schedule_id = $request->schedule_id;
        $activity->subject_id = $request->subject_id;
        $activity->created_by = $user->id;
        $activity->activity_type = $request->activity_type;
        $activity->available_from = $request->available_from;
        $activity->available_to = $request->available_to;
        $activity->published = $request->published;

        $activity->save();

        $fractal = fractal()->item($activity, new AssignmentTransformer);

       return response()->json($fractal->toArray());
    }

    /**
     * Publish activity
     *
     * @api {POST} HOST/api/class/activity/publish/{id} Publish Activity
     * @apiVersion 1.0.0
     * @apiName PublishActivity
     * @apiDescription Publish activity to students
     * @apiGroup Activity
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of activity to be published
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
    public function publish(Request $request)
    {
        $activity = Assignment::find($request->id);
        $activity->published = 1;
        
        try{
            $activity->save();
            return response()->json(['success' => true]);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false]);
        };        
    }
    /**
     * Activity Detail
     *
     * @api {POST} HOST/api/class/activity/{id} Activity Detail
     * @apiVersion 1.0.0
     * @apiName ActivityDetail
     * @apiDescription Get activity details
     * @apiGroup Activity
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of activity
     *
     * @apiSuccess {Number} id Activity ID
     * @apiSuccess {String} title
     * @apiSuccess {String} description
     * @apiSuccess {String} activity_type
     * @apiSuccess {Date} available_from
     * @apiSuccess {Date} available_to
     * @apiSuccess {String} status published/unpublished
     * @apiSuccess {Array} materials
     * @apiSuccess {Number} materials.id any uploaded materials
     * @apiSuccess {String} materials.uploaded_file If there's any uploaded file e.g. pdf, word, excel, ppt
     * @apiSuccess {String} materials.resource_link Link to materials e.g google doc, website,etc
     * @apiSuccess {Array} submissions list of students and submission status - AVAILABLE IN TEACHERS PROFILE ONLY
     * @apiSuccess {String} submissions.first_name
     * @apiSuccess {String} submissions.last_name
     * @apiSuccess {String} submissions.status
     * @apiSuccess {DateTime} submissions.date_submitted
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 1,
            "title": "English Assignment 1",
            "description": "read it",
            "activity_type": "class activity",
            "available_from": "2020-05-11",
            "available_to": "2020-05-15",
            "status": "published",
            "materials": [
                {
                    "id": 1,
                    "uploaded_file": "",
                    "resource_link": "http://read-english.com/basics"
                },
                {
                    "id": 2,
                    "uploaded_file": "http://link-to-uploaded-file/sample"
                }
            ],
            "submissions": [
                {
                    "first_name": "jayson",
                    "last_name": "barino",
                    "status": "DONE",
                    "date_submitted": "2020-05-30 16:17:15"
                },
                {
                    "first_name": "grace",
                    "last_name": "ungui",
                    "status": "PENDING",
                    "date_submitted": null
                },
                {
                    "first_name": "jen",
                    "last_name": "castillo",
                    "status": "PENDING",
                    "date_submitted": null
                },
                {
                    "first_name": "davy",
                    "last_name": "castillo",
                    "status": "PENDING",
                    "date_submitted": null
                }
            ]
        }
     *
     * 
     * 
     */
    public function show(Request $request)
    {
        
        $user =  Auth::user();

        if($request->include == 'submissions' && $user->user_type != 't')
        {
            return response('Unauthorized access to included data', 403);
        }

        $activity = Assignment::with([
            'viewers' => function($student){
                $student->with([
                    'submittedActivity' => function($answer){
                        $answer->where('assignment_id', 1);
                    }
                ]);
            }
        ])
        ->whereId($request->id)->first();

        $activity->viewers = \App\TransferObjects\AssignmentSubmissions::create([
            'submissions' => $activity->viewers
        ]);

        $fractal = fractal()->item($activity, new AssignmentTransformer);
        if($user->user_type == 't') {
            $fractal->includeSubmissions();
        }

        return response()->json($fractal->toArray());    
    }

    /**
     * Remove Activity Material
     *
     * @api {post} HOST/api/teacher/remove/class-activity-material/{id} Remove Activity Material
     * @apiVersion 1.0.0
     * @apiName RemoveActivityMaterial
     * @apiDescription SRemove Material of an Activity
     * @apiGroup Teacher Classes
     *
     * @apiParam {Number} id Activity Material ID.
     *
     * @apiSuccess {String} success returns true if ID is found. Otherwise, returns error code 404.
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */
    public function removeAssignmentMaterial(Request $request)
    {
		$assignment_material = AssignmentMaterial::findOrFail($request->id);

        $assignment_material->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Save Activity Material
     *
     * @api {post} HOST/class/activity-material/save Save Activity Material
     * @apiVersion 1.0.0
     * @apiName SaveActivityMaterial
     * @apiDescription Save Activity Material
     * @apiGroup Activity
     *
     * @apiParam {Number} id Activity Material ID, if supplied, will update the activity material. Otherwise, will create new.
     * @apiParam {String} url Resource Link
     * @apiParam {Number} activity_id ID of the Activity
     * 
     * @apiSuccess {Number} id Activity Material ID.
     * @apiSuccess {String} uploaded_file Uploaded file if exists.
     * @apiSuccess {String} resource_link URL of the activity material.
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 3,
            "uploaded_file": "",
            "resource_link": "sample-activity-material-link-2.com"
        }
     *
     * 
     * 
     */
    public function saveActivityMaterial(Request $request)
    {
        $request->validate([
            'id' => 'integer',
            'url' => 'string',
            'activity_id' => 'integer|required'
        ]);

        $user =  Auth::user();

		$assignment_material = AssignmentMaterial::findOrNew($request->id);
        $assignment_material->link_url = $request->url;
        $assignment_material->assignment_id = $request->activity_id;
		$assignment_material->save();

        $fractal = fractal()->item($assignment_material, new AssignmentMaterialTransformer);

        return response()->json($fractal->toArray());
    }


    /**
     * Remove Class Activity
     *
     * @api {post} HOST/api/teacher/remove/class-activity/{id} Remove Class Activity
     * @apiVersion 1.0.0
     * @apiName RemoveClassActivity
     * @apiDescription Remove Class Activity
     * @apiGroup Activity
     *
     * @apiParam {Number} id Class Activity ID.
     *
     * @apiSuccess {String} success returns true if ID is found. Otherwise, returns error code 404.
     *
     *
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     *
     *
     */
    public function remove(Request $request)
    {
        $user =  Auth::user();

		$assignment = Assignment::findOrFail($request->id);
        $assignment->delete();

        return response()->json(['success' => true]);
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
