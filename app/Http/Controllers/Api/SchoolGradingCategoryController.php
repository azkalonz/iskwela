<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\SchoolGradingCategory;
use App\Transformers\SchoolGradingCategoryTransformer;

class SchoolGradingCategoryController extends Controller
{
    /**
     * School Grading Category Save
     *
     * @api {post} <HOST>/api/school-grading-category/save Add/Edit School Grading Category
     * @apiVersion 1.0.0
     * @apiName SaveSchoolGradingCategory
     * @apiDescription Saves School Grading Category
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the School Grading Category ID. If not supplied, adds new category, otherwise updates the supplied ID.
     * @apiParam {String} category Name of the grading category. Required when creating a new category.
     * @apiParam {Number} category_percentage Category Percentage between 0 and 1. Required when creating a new category.
     *
     * @apiSuccess {Number} id School Grading Category ID
     * @apiSuccess {Number} school_id ID of the school that uses the category. Taken from user's school ID
     * @apiSuccess {String} category name of the grading category
     * @apiSuccess {String} category_percentage grading category percentage (between 0 - 1)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 6,
            "school_id": 1,
            "category": "Performance Test",
            "category_percentage": 0.1
        }
     * 
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'id' => 'integer',
            'category_percentage' => 'numeric|between:0,1'
        ]);

        $user =  Auth::user();

        if($request->id)
        {   $grading_category = SchoolGradingCategory::find($request->id);
            if($grading_category)
            {
                $grading_category->updated_by = $user->id;
            }
            else{
                return response('Grading Category Not Found', 404);
            }
        }else{
            $grading_category = new SchoolGradingCategory();

            $this->validate($request, [
                'category_percentage' => 'required',
                'category' => 'required'
            ]);

            $grading_category->created_by = $user->id;
            $grading_category->school_id = $user->school_id;
        }

        if($request->category_percentage){
            $grading_category->category_percentage = $request->category_percentage;
        }
        
        if($request->category){
            $grading_category->category= $request->category;
        }

        $grading_category->save();

        $fractal = fractal()->item($grading_category, new SchoolGradingCategoryTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * School Grading Category Show
     *
     * @api {get} <HOST>/api/school-grading-categories Get School Grading Categories
     * @apiVersion 1.0.0
     * @apiName GetSchoolGradingCategory
     * @apiDescription Gets the grading categories the school of the logged in user.
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Number} id School Grading Category ID
     * @apiSuccess {Number} school_id ID of the school that uses the category. Taken from user's school ID
     * @apiSuccess {String} category name of the grading category
     * @apiSuccess {String} category_percentage grading category percentage (between 0 - 1)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "school_id": 1,
                "category": "Periodical Exam",
                "category_percentage": "0.3"
            },
            {
                "id": 2,
                "school_id": 1,
                "category": "Written Works",
                "category_percentage": "0.2"
            },
            {
                "id": 3,
                "school_id": 1,
                "category": "Participation",
                "category_percentage": "0.4"
            },
            {
                "id": 4,
                "school_id": 1,
                "category": "Performance",
                "category_percentage": "0.1"
            }
        ]
     * 
     */
    public function show(Request $request)
    {
        $user =  Auth::user();

        $grading_category = SchoolGradingCategory::whereSchoolId($user->school_id);

        if(!$grading_category){
            return response('Grading Categories Not Found', 404);            
        }

        $fractal = fractal()->collection($grading_category->get(), new SchoolGradingCategoryTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * School Grading Category Delete
     *
     * @api {delete} <HOST>/api/school-grading-category/remove/:id Delete School Grading Category
     * @apiVersion 1.0.0
     * @apiName DeleteSchoolGradingCategory
     * @apiDescription Deletes the School Grading Category
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} id ID of school grading category to delete
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function remove(Request $request)
	{
		$user = Auth::user();
		$grading_category = SchoolGradingCategory::find($request->id);

		if(!$grading_category) {
			return response('Grading Category not found', 404);
		}

        $success = false;
		if($grading_category->delete()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
