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
use \App\Models\SchoolGradingCategory;
use \App\Transformers\AssignmentTransformer;
use \App\Transformers\AssignmentMaterialTransformer;

class AssignmentController extends Controller
{
	const SEATWORK = 1;
	const PROJECT = 2;
	const ASSIGNMENT = 3;

   /** 
    * Seatworks
    *
    * @api {POST} HOST/api/class/seatwork/save Add/Edit Seatwork
    * @apiVersion 1.0.0
    * @apiName addSeatwork
    * @apiDescription Add new seatwork
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    *
    * @apiParam {String} title title of seatwork
    * @apiParam {String} description
    * @apiParam {DateTime} due_date deadline of seatwork to be submitted
    * @apiParam {Number=0,1} published 0: not published, 1:published
    * @apiParam {Number} subject_id
    * @apiParam {Number} schedule_id
    * @apiParam {Number} class_id
    * @apiParam {Number} total_score the expected perfect score for this seatwork
    * @apiParam {Number} grading_category the grading category ID
    *
    * @apiUse SeatWorkDetails
    * 
   */
    public function addSeatwork(Request $request)
    {
        return $this->save($request, self::SEATWORK);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/class/project/save Add/Edit Project
    * @apiVersion 1.0.0
    * @apiName addProject
    * @apiDescription Add new project
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {String} title title of project
    * @apiParam {String} description
    * @apiParam {DateTime} due_date deadline of project to be submitted
    * @apiParam {Number=0,1} published 0: not published, 1:published
    * @apiParam {Number} subject_id
    * @apiParam {Number} schedule_id
    * @apiParam {Number} class_id
    * @apiParam {Number} total_score the expected perfect score for this project
    * @apiParam {Number} grading_category the grading category ID
    *
    * @apiSuccess {Number} id ID of the created project
    * @apiSuccess {String} title
    * @apiSuccess {String} description
    * @apiSuccess {String=project} activity_type
    * @apiSuccess {Number} grading_category the grading category ID
    * @apiSuccess {Number} total_score the expected perfect score for this project
    * @apiSuccess {DateTime} due_date deadline of project to be submitted
    * @apiSuccess {String=unpublished,published} status
    * @apiSuccess {Boolean} done indicates if project is closed/open for takes 
    * @apiSuccess {Array} materials array of materials attached to the assignment
    * @apiSuccess {Number} materials.id material ID
    * @apiSuccess {String} materials.title material title
    * @apiSuccess {String} materials.uploaded_file link to uploaded file if any
    * @apiSuccess {String} materials.resource_link URL link to resource
    * @apiSuccessExample {json} Sample Response
        {
            "id": 7,
            "title": "Cross Stitch",
            "description": "Create a beautiful cross stitch.",
            "activity_type": "project",
            "grading_category": 1,
            "total_score": 50,
            "due_date": "2020-07-10 10:00:00",
            "status": "unpublished",
            "done": "false",
            "materials": [
                {
                    "id": 4,
                    "title": "Test assignment 2",
                    "uploaded_file": "",
                    "resource_link": "sample-activity-material-link3.com"
                }
            ]
        }
    *
    * 
    * 
   */
    public function addProject(Request $request)
    {
        return $this->save($request, self::PROJECT);
    }

   /**
    * Assignment Free-style
    *
    * @api {POST} HOST/api/assignment/v2/save Add/Edit Assignment
    * @apiVersion 1.0.0
    * @apiName addFreeStyleAssignment
    * @apiDescription Add new free-style assignment
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {String} title title of assignment
    * @apiParam {String} description
    * @apiParam {DateTime} due_date deadline of assignment to be submitted
    * @apiParam {Number=0,1} published 0: not published, 1:published
    * @apiParam {Number} subject_id
    * @apiParam {Number} schedule_id
    * @apiParam {Number} class_id
    * @apiParam {Number} total_score the expected perfect score for this assignment
    * @apiParam {Number} grading_category the grading category ID
    *
    * @apiSuccess {Number} id ID of the created assignment
    * @apiSuccess {String} title
    * @apiSuccess {String} description
    * @apiSuccess {String=assignment} activity_type
    * @apiSuccess {Number} grading_category the grading category ID
    * @apiSuccess {Number} total_score the expected perfect score for this assignment
    * @apiSuccess {DateTime} due_date deadline of assignment to be submitted
    * @apiSuccess {String=unpublished,published} status
    * @apiSuccess {Boolean} done indicates if assignment is closed/open for takes
    * @apiSuccess {Array} materials array of materials attached to the assignment
    * @apiSuccess {Number} materials.id material ID
    * @apiSuccess {String} materials.title material title
    * @apiSuccess {String} materials.uploaded_file link to uploaded file if any
    * @apiSuccess {String} materials.resource_link URL link to resource
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "id": 5,
            "title": "New assignment Test",
            "description": "assignment free description",
            "activity_type": "assignment",
            "grading_category": 1,
            "total_score": 100,
            "due_date": "2020-07-10 10:00:00",
            "status": "unpublished",
            "done": "false",
            "materials": [
                {
                    "id": 4,
                    "title": "Test assignment 2",
                    "uploaded_file": "",
                    "resource_link": "sample-activity-material-link3.com"
                }
            ]
        }
    *
    * 
    * 
   */
    public function addAssignment(Request $request)
    {
        return $this->save($request, self::ASSIGNMENT);
    }
   /**
    * Seatworks
    *
    * @api {POST} HOST/api/class/seatwork/publish/:id Publish Seatwork
    * @apiVersion 1.0.0
    * @apiName publishSeatworks
    * @apiDescription Publish seatwork to be available for students
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of seatwork to be published
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
    public function publishSeatwork(Request $request)
    {
        return $this->publish($request, self::SEATWORK);
    }

   /**
    * Assignment Free-style
    *
    * @api {POST} HOST/api/assignment/v2/publish/:id Publish Assignment
    * @apiVersion 1.0.0
    * @apiName publishFreeStyleAssignment
    * @apiDescription Publish seatwork to be available for students
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of assignment to be published
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
    public function publishAssignment(Request $request)
    {
        return $this->publish($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/class/project/publish/:id Publish Project
    * @apiVersion 1.0.0
    * @apiName publishProject
    * @apiDescription Publish project to be available for students
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of project to be published
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
    public function publishProject(Request $request)
    {
        return $this->publish($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {get} HOST/api/class/seatwork/:id Seatwork Details
    * @apiVersion 1.0.0
    * @apiName showSeatwork
    * @apiDescription Show seatwork details
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of seatwork to be viewed
    *
    * @apiUse SeatWorkDetails
    * 
   */
    public function showSeatwork(Request $request)
    {
        return $this->show($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {get} HOST/api/assignment/v2/:id Assignment Details
    * @apiVersion 1.0.0
    * @apiName showFreeStyleAssignment
    * @apiDescription Show assignment details
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of assignment to be viewed
    *
    * @apiUse AssignmentDetails
    * 
   */
    public function showAssignment(Request $request)
    {
        return $this->show($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {get} HOST/api/class/project/:id Project Details
    * @apiVersion 1.0.0
    * @apiName showProject
    * @apiDescription Show project details
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of project to be viewed
    *
    * @apiUse ProjectDetails
    * 
   */
    public function showProject(Request $request)
    {
        return $this->show($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/teacher/remove/class-seatwork-material/:id Delete Seatwork Material
    * @apiVersion 1.0.0
    * @apiName removeSeatworkMaterial
    * @apiDescription Remove attached material from the seatwork
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the seatwork ID
    *
    * @apiSuccess {Boolean=true,false} success
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function removeSeatworkMaterial(Request $request)
    {
        return $this->removeAssignmentMaterial($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/remove/material/:id Delete Assignment Material
    * @apiVersion 1.0.0
    * @apiName removeFreeStyleAssignmentMaterial
    * @apiDescription Remove attached material from the assignment
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the assignment ID
    *
    * @apiSuccess {Boolean=true,false} success
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function removeFreeStyleAssignmentMaterial(Request $request)
    {
        return $this->removeAssignmentMaterial($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/teacher/remove/class-project-material/:id Delete Project Material
    * @apiVersion 1.0.0
    * @apiName removeProjectMaterial
    * @apiDescription Remove attached material from the project
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id the project ID
    *
    * @apiSuccess {Boolean=true,false} success
    * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    *
    * 
   */
    public function RemoveProjectMaterial(Request $request)
    {
        return $this->removeAssignmentMaterial($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/class/seatwork-material/save Add/Edit Material (URL)
    * @apiVersion 1.0.0
    * @apiName addSeatworkMaterialUrl
    * @apiDescription Add a link to seatwork's material
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} [id] if supplied, edits the existing material
    * @apiParam {Number} activity_id ID of seatwork
    * @apiParam {String} url link to resource
    * @apiParam {String} title
    *
    * @apiSuccess {Number} id the ID of added material
    * @apiSuccess {String} title
    * @apiSuccess {String} uploaded_file link to uploaded file if any
    * @apiSuccess {String} resource_link URL to resource
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "id": 7,
            "title": "Test Title 2",
            "uploaded_file": "",
            "resource_link": "sample-activity-material-link3.com"
        }
    *
    * 
   */
    public function saveSeatworkMaterial(Request $request)
    {
        return $this->saveActivityMaterial($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/material/save Add/Edit Material (URL)
    * @apiVersion 1.0.0
    * @apiName addFreeStyleAssignmentMaterialUrl
    * @apiDescription Add a link to assignments's material
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} [id] if supplied, edits the existing material
    * @apiParam {Number} activity_id ID of assignment
    * @apiParam {String} url link to resource
    * @apiParam {String} title
    *
    * @apiSuccess {Number} id the ID of added material
    * @apiSuccess {String} title
    * @apiSuccess {String} uploaded_file link to uploaded file if any
    * @apiSuccess {String} resource_link URL to resource
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "id": 7,
            "title": "Test Title 2",
            "uploaded_file": "",
            "resource_link": "sample-activity-material-link3.com"
        }
    *
    * 
   */
    public function saveAssignmentMaterial(Request $request)
    {
        return $this->saveActivityMaterial($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/class/project-material/save Add/Edit Material (URL)
    * @apiVersion 1.0.0
    * @apiName addProjectMaterialUrl
    * @apiDescription Add a link to projects's material
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} [id] if supplied, edits the existing material
    * @apiParam {Number} activity_id ID of project
    * @apiParam {String} url link to resource
    * @apiParam {String} title
    *
    * @apiSuccess {Number} id the ID of added material
    * @apiSuccess {String} title
    * @apiSuccess {String} uploaded_file link to uploaded file if any
    * @apiSuccess {String} resource_link URL to resource
    * 
    * @apiSuccessExample {json} Sample Response
        {
            "id": 7,
            "title": "Test Title 2",
            "uploaded_file": "",
            "resource_link": "sample-activity-material-link3.com"
        }
    *
    * 
   */
    public function saveProjectMaterial(Request $request)
    {
        return $this->saveActivityMaterial($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/class/seatwork/mark-done/:id Mark Done
    * @apiVersion 1.0.0
    * @apiName SeatworkDone
    * @apiDescription Mark seatwork to done
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of seatwork to be done/closed
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
    public function markSeatworkDone(Request $request)
    {
        return $this->markDone($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/mark-done/:id Mark Done
    * @apiVersion 1.0.0
    * @apiName FreeStyleAssignmentDone
    * @apiDescription Mark assignment to done
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of assignment to be done/closed
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
    public function markAssignmentDone(Request $request)
    {
        return $this->markDone($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/class/project/mark-done/:id Mark Done
    * @apiVersion 1.0.0
    * @apiName ProjectDone
    * @apiDescription Mark project to done
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of project to be done/closed
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
    public function markProjectDone(Request $request)
    {
        return $this->markDone($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/class/seatwork/mark-not-done/:id Mark Undone
    * @apiVersion 1.0.0
    * @apiName SeatworkUndone
    * @apiDescription Mark seatwork to undone
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of seatwork to be undone/open
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
    public function markSeatworkNotDone(Request $request)
    {
        return $this->markNotDone($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/mark-not-done/:id Mark Undone
    * @apiVersion 1.0.0
    * @apiName FreeStyleAssignmentUndone
    * @apiDescription Mark assignment to undone
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of assignment to be undone/open
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
    public function markAssignmentNotDone(Request $request)
    {
        return $this->markNotDone($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/class/project/mark-not-done/:id Mark Undone
    * @apiVersion 1.0.0
    * @apiName ProjectUndone
    * @apiDescription Mark project to undone
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of project to be undone/open
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
    public function markProjectNotDone(Request $request)
    {
        return $this->markNotDone($request, self::PROJECT);
    }

   /**
    * Seatworks
    *
    * @api {POST} HOST/api/teacher/remove/class-seatwork/:id Delete Seatwork
    * @apiVersion 1.0.0
    * @apiName SeatworkDelete
    * @apiDescription Delete the seatwork
    * @apiGroup Seatworks
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of seatwork to be deleted
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
    public function removeSeatwork(Request $request)
    {
        return $this->remove($request, self::SEATWORK);
    }

   /**
    * Assignment Free-Style
    *
    * @api {POST} HOST/api/assignment/v2/remove/:id Delete Assigment
    * @apiVersion 1.0.0
    * @apiName FreeStyleAssignmentDelete
    * @apiDescription Delete the assignment
    * @apiGroup Assignments: Free-Style
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of assignment to be deleted
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
    public function removeFreeStyleAssignment(Request $request)
    {
        return $this->remove($request, self::ASSIGNMENT);
    }

   /**
    * Projects
    *
    * @api {POST} HOST/api/teacher/remove/class-project/:id Delete Project
    * @apiVersion 1.0.0
    * @apiName ProjectDelete
    * @apiDescription Delete the project
    * @apiGroup Projects
    *
    * @apiUse JWTHeader
    * @apiParam {Number} id ID of project to be deleted
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
    public function removeProject(Request $request)
    {
        return $this->remove($request, self::PROJECT);
    }

    public function save(Request $request, int $activity_type)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'published' => 'integer|required',
            'subject_id' => 'integer|required',
            'schedule_id' => 'integer|required',
            'class_id' => 'integer|required',
            "grading_category" => 'integer|required',
            'total_score' => 'integer|required|min:1'
        ]);

        $user =  Auth::user();

        $grading_category = SchoolGradingCategory::findOrFail($request->grading_category);

        $activity = Assignment::findOrNew($request->id);
        $activity->title = $request->title;
        $activity->instruction = $request->description;
        $activity->class_id = $request->class_id;
        $activity->schedule_id = $request->schedule_id;
        $activity->subject_id = $request->subject_id;
        $activity->created_by = $user->id;
        $activity->activity_type = $request->activity_type;
        $activity->due_date = $request->due_date;
        $activity->published = $request->published;
        $activity->total_score = $request->total_score;
        $activity->activity_type = $activity_type;
        $activity->grading_category = $request->grading_category;

        $activity->save();
        $activity = Assignment::find($activity->id);

        $fractal = fractal()->item($activity, new AssignmentTransformer);

       return response()->json($fractal->toArray());
    }

    public function publish(Request $request, int $activity_type)
    {
        $activity = Assignment::where('id', '=', $request->id)->where('activity_type', '=', $activity_type)->firstOrFail();
        $activity->published = 1;
        
        try{
            $activity->save();
            return response()->json(['success' => true]);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false]);
        };        
    }
    public function show(Request $request, int $activity_type)
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
        ->whereId($request->id)->where('activity_type', '=', $activity_type)->firstOrFail();
        $activity->viewers = \App\TransferObjects\AssignmentSubmissions::create([
            'submissions' => $activity->viewers
        ]);

        $fractal = fractal()->item($activity, new AssignmentTransformer);
        if($user->user_type == 't') {
            $fractal->includeSubmissions();
        }

        return response()->json($fractal->toArray());    
    }

    public function removeAssignmentMaterial(Request $request, int $activity_type)
    {
        //$assignment = Assignment::whereId($request->activity_id)->where('activity_type', '=', $activity_type)->firstOrFail();
        $assignment_material = AssignmentMaterial::findOrFail($request->id);

        $assignment = Assignment::whereId($assignment_material->assignment_id)->whereActivityType($activity_type)->firstOrFail();

        $assignment_material->delete();
        
        return response()->json(['success' => true]);
    }

    public function saveActivityMaterial(Request $request, int $activity_type)
    {
        $request->validate([
            'id' => 'integer',
            'url' => 'string',
            'activity_id' => 'integer|required',
            'title' => 'string'
        ]);

        $user =  Auth::user();

        $assignment = Assignment::whereId($request->activity_id)->where('activity_type', '=', $activity_type)->firstOrFail();

		$assignment_material = AssignmentMaterial::findOrNew($request->id);
        $assignment_material->link_url = $request->url;
        $assignment_material->assignment_id = $request->activity_id;
        $assignment_material->title = $request->title;
		$assignment_material->save();

        $fractal = fractal()->item($assignment_material, new AssignmentMaterialTransformer);

        return response()->json($fractal->toArray());
    }


    public function remove(Request $request, int $activity_type)
    {
        $user =  Auth::user();

        $assignment = Assignment::whereId($request->id)->whereActivityType($activity_type)->firstOrFail();
        $assignment->delete();

        return response()->json(['success' => true]);
    }


    public function markDone(Request $request, int $activity_type)
    {
        return $this->setDoneStatus($request->id, 1, $activity_type);   
    }   

    public function markNotDone(Request $request, int $activity_type)
    {
        return $this->setDoneStatus($request->id, 0, $activity_type);
    }

    private function setDoneStatus($assignment_id, $status, $activity_type)
    {
        //$teacher = Auth::user();
        $activity = Assignment::whereId($assignment_id)->whereActivityType($activity_type)->firstOrFail();

        $activity->done = $status;

        if($activity->save())
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
    */

   /**
    * @apiDefine SeatWorkDetails
    * @apiSuccess {Number} id ID of the created seatwork
    * @apiSuccess {String} title
    * @apiSuccess {String} description
    * @apiSuccess {String=seatwork} activity_type
    * @apiSuccess {Number} grading_category the grading category ID
    * @apiSuccess {Number} total_score the expected perfect score for this seatwork
    * @apiSuccess {DateTime} due_date deadline of seatwork to be submitted
    * @apiSuccess {String=unpublished,published} status
    * @apiSuccess {Boolean} done indicates if seatwork is closed/open for takes 
    * @apiSuccess {Array} materials array of materials attached to the assignment
    * @apiSuccess {Number} materials.id material ID
    * @apiSuccess {String} materials.title material title
    * @apiSuccess {String} materials.uploaded_file link to uploaded file if any
    * @apiSuccess {String} materials.resource_link URL link to resource
    * @apiSuccessExample {json} Sample Response
        {
            "id": 6,
            "title": "New Seatwork Test",
            "description": "Seatwork description",
            "activity_type": "seatwork",
            "grading_category": 1,
            "total_score": 100,
            "due_date": "2020-07-10 10:00:00",
            "status": "unpublished",
            "done": "false",
            "materials": [
                {
                    "id": 4,
                    "title": "Test assignment 2",
                    "uploaded_file": "",
                    "resource_link": "sample-activity-material-link3.com"
                }
            ]
        }
    *
    * 
   */

   /**
    * @apiDefine AssignmentDetails
    * @apiSuccess {Number} id ID of the created assignment
    * @apiSuccess {String} title
    * @apiSuccess {String} description
    * @apiSuccess {String=assignment} activity_type
    * @apiSuccess {Number} grading_category the grading category ID
    * @apiSuccess {Number} total_score the expected perfect score for this assignment
    * @apiSuccess {DateTime} due_date deadline of assignment to be submitted
    * @apiSuccess {String=unpublished,published} status
    * @apiSuccess {Boolean} done indicates if assignment is closed/open for takes 
    * @apiSuccess {Array} materials array of materials attached to the assignment
    * @apiSuccess {Number} materials.id material ID
    * @apiSuccess {String} materials.title material title
    * @apiSuccess {String} materials.uploaded_file link to uploaded file if any
    * @apiSuccess {String} materials.resource_link URL link to resource
    * @apiSuccessExample {json} Sample Response
        {
            "id": 6,
            "title": "New Assignment Test",
            "description": "Assignment description",
            "activity_type": "assignment",
            "grading_category": 1,
            "total_score": 100,
            "due_date": "2020-07-10 10:00:00",
            "status": "unpublished",
            "done": "false",
            "materials": [
                {
                    "id": 4,
                    "title": "Test assignment 2",
                    "uploaded_file": "",
                    "resource_link": "sample-activity-material-link3.com"
                }
            ]
        }
    *
    * 
   */

   /**
    * @apiDefine ProjectDetails
    * @apiSuccess {Number} id ID of the created project
    * @apiSuccess {String} title
    * @apiSuccess {String} description
    * @apiSuccess {String=project} activity_type
    * @apiSuccess {Number} grading_category the grading category ID
    * @apiSuccess {Number} total_score the expected perfect score for this project
    * @apiSuccess {DateTime} due_date deadline of project to be submitted
    * @apiSuccess {String=unpublished,published} status
    * @apiSuccess {Boolean} done indicates if project is closed/open for takes 
    * @apiSuccess {Array} materials array of materials attached to the assignment
    * @apiSuccess {Number} materials.id material ID
    * @apiSuccess {String} materials.title material title
    * @apiSuccess {String} materials.uploaded_file link to uploaded file if any
    * @apiSuccess {String} materials.resource_link URL link to resource
    * @apiSuccessExample {json} Sample Response
        {
            "id": 6,
            "title": "New Project Test",
            "description": "Project description",
            "activity_type": "Project",
            "grading_category": 1,
            "total_score": 100,
            "due_date": "2020-07-10 10:00:00",
            "status": "unpublished",
            "done": "false",
            "materials": [
                {
                    "id": 4,
                    "title": "Test project 2",
                    "uploaded_file": "",
                    "resource_link": "sample-activity-material-link3.com"
                }
            ]
        }
    *
    * 
   */
}
