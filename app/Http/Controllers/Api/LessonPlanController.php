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
     * @api <HOST>/class/lesson-plan/save Save class lesson plan
     * @apiVersion 1.0.0
     * @apiName SaveLessonPlan
     * @apiDescription Saves lesson plan URL and title
     * @apiGroup Lesson Plan
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} schedule_id the schedule ID
     * @apiParam {String} URL web link of the lesson plan.
     * @apiParam {String} title Title of the lesson plan.
     * @apiParam {String} title Title of the lesson plan.
     * @apiParam {Number} class_id the Class ID.
     * @apiParam {Number} id Lesson Plan ID; If given, API will update the lesson plan ID, otherwise, will add new lesson plan.
     *
     * @apiSuccess {Number} lessonPlans.id the Lesson Plan ID
     * @apiSuccess {String} lessonPlans.title
     * @apiSuccess {String} lessonPlans.uploaded_file link to uploaded file or
     * @apiSuccess {String} lessonPlans.resource_link a shared reference link (google docs, etc)
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
            'URL' => 'required',
            'schedule_id' => 'integer|required',
			'class_id' => 'integer|required',
			'title' => 'required'
        ]);

        $user =  Auth::user();

		$lesson_plan = LessonPlan::findOrNew($request->id);

		if(!isset($request->id))
		{
			$lesson_plan->created_by = $user->id;
		}

		$lesson_plan->link_url = $request->URL;
		$lesson_plan->schedule_id = $request->schedule_id;
		$lesson_plan->class_id = $request->class_id;
		$lesson_plan->title = $request->title;
		$lesson_plan->updated_by = $user->id;
		$lesson_plan->save();

        $fractal = fractal()->item($lesson_plan, new LessonPlanTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
