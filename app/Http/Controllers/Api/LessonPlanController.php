<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\LessonPlanTransformer;
use Auth;
use App\Models\LessonPlan;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class LessonPlanController extends Controller
{
    /**
     * Class Lesson Plan Save
     *
     * @api {post} <HOST>/api/class/lesson-plan/save Add/Edit Lesson Plan
     * @apiVersion 1.0.0
     * @apiName SaveLessonPlan
     * @apiDescription Saves lesson plan URL and title
     * @apiGroup Lesson Plan
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} schedule_id the schedule ID
     * @apiParam {String} url web link of the lesson plan.
     * @apiParam {String} title Title of the lesson plan.
     * @apiParam {Number} class_id the Class ID.
     * @apiParam {Number} id Lesson Plan ID; If given, API will update the lesson plan ID, otherwise, will add new lesson plan.
     *
     * @apiSuccess {Number} lessonPlans.id the Lesson Plan ID
     * @apiSuccess {String} lessonPlans.title
     * @apiSuccess {String} lessonPlans.uploaded_file link to uploaded file or
     * @apiSuccess {String} lessonPlans.resource_link a shared reference link (google docs, etc)
     * @apiSuccess {Boolean} lessonPlans.done returns true if lesson plan has been marked as done, otherwise, false
     * @apiSuccess {Object} added_by the teacher/user who added this lesson plan
     * @apiSuccess {Number} added_by.id
     * @apiSuccess {String} added_by.first_name
     * @apiSuccess {String} added_by.last_name
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
			"id": 2,
			"title": "Hello Lesson Plan",
			"uploaded_file": "",
			"resource_link": "http://sample-lessson-plan-link.com",
			"added_by": {
				"id": 9,
				"first_name": "teacher jayson",
				"last_name": "barino"
			}
		}
     * 
     */
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'integer',
            'url' => 'string',
            'schedule_id' => 'integer|required',
			'class_id' => 'integer|required',
			'title' => 'required'
        ]);

        $user =  Auth::user();

		$lesson_plan = LessonPlan::findOrNew($request->id);

		$lesson_plan->created_by = $user->id;

		$lesson_plan->link_url = $request->url;
		$lesson_plan->schedule_id = $request->schedule_id;
		$lesson_plan->class_id = $request->class_id;
		$lesson_plan->title = $request->title;
        $lesson_plan->updated_by = $user->id;
        $lesson_plan->save();

        $lesson_plan = LessonPlan::find($lesson_plan->id);

        $fractal = fractal()->item($lesson_plan, new LessonPlanTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Remove Lesson Plan
     *
     * @api {post} HOST/api/teacher/remove/class-lesson-plan/{id} Remove Lesson Plan
     * @apiVersion 1.0.0
     * @apiName RemoveLessonPlan
     * @apiDescription Removes Lesson Plan
     * @apiGroup Teacher Classes
     *
     * @apiParam {Number} id Lesson Plan ID
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

		$lesson_plan = LessonPlan::findOrFail($request->id);

        $lesson_plan->updated_by = $user->id;
        $lesson_plan->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Lesson Plan - Mark Not Done
     *
     * @api {POST} HOST/api/class/lesson-plan/mark-done/{id} Lesson Plan Mark Done
     * @apiVersion 1.0.0
     * @apiName LessonPlanMarkDone
     * @apiDescription Marks Lesson Plan as Done
     * @apiGroup Lesson Plan
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of lesson plan
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
    public function markDone(Request $request)
    {
        return $this->setDoneStatus($request->id, 1);   
    }

    /**
     * Lesson Plan - Mark Not Done
     *
     * @api {POST} HOST/api/class/lesson-plan/mark-not-done/{id} Lesson Plan Mark Not Done
     * @apiVersion 1.0.0
     * @apiName LessonPlanMarkNotDone
     * @apiDescription Marks Lesson Plan as Not Done
     * @apiGroup Lesson Plan
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of lesson plan
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
    public function markNotDone(Request $request)
    {
        return $this->setDoneStatus($request->id, 0);   
    }

    private function setDoneStatus($lesson_plan_id, $status)
    {
        $teacher = Auth::user();
        $lesson_plan = LessonPlan::find($lesson_plan_id);
        
        if(!$lesson_plan->first()) {
            return response('Lesson Plan not Found.', 404);
        }
        
        if($lesson_plan->created_by != $teacher->id) {
            return response('Unauthorized.', 401);
        }

        $lesson_plan->done = $status;
        if($lesson_plan->save())
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
