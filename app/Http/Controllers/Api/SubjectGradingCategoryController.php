<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\SubjectGradingCategory;
use App\Transformers\SubjectGradingCategoryTransformer;

class SubjectGradingCategoryController extends Controller
{
    /**
     * Subject Grading Category Save
     *
     * @api {post} <HOST>/api/subject-grading-category/save Add/Edit Subject Grading Category
     * @apiVersion 1.0.0
     * @apiName SaveSubjectGradingCategory
     * @apiDescription Saves Subject Grading Category
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the Subject Grading Category ID. If not supplied, adds new category, otherwise updates the supplied ID.
     * @apiParam {Number} category_id ID of the School Grading Category. Required when creating a new category.
     * @apiParam {Number} subject ID of the Subject. Required when creating a new category.
     * @apiParam {Number} category_percentage Category Percentage between 0 and 1. Required when creating a new category.
     *
     * @apiSuccess {Number} id Subject Grading Category ID
     * @apiSuccess {Number} subject_id Subject ID
     * @apiSuccess {Number} category_id School Grading Category ID
     * @apiSuccess {Number} category_percentage subject grading category percentage (between 0 - 1)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 4,
            "subject_id": 1,
            "category_id": 4,
            "category_percentage": 0.2
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
        {   $grading_category = SubjectGradingCategory::find($request->id);
            if($grading_category)
            {
                $grading_category->updated_by = $user->id;
            }
            else{
                return response('Grading Category Not Found', 404);
            }
        }else{
            $grading_category = new SubjectGradingCategory();
            $grading_category->created_by = $user->id;

            $this->validate($request, [
                'subject_id' => 'integer|required',
                'category_id' => 'integer|required',
                'category_percentage' => 'required'
            ]);
        }

        if($request->category_percentage){
            $grading_category->category_percentage = $request->category_percentage;
        }
        
        if($request->category_id){
            $grading_category->category_id = $request->category_id;
        }

        if($request->subject_id){
            $grading_category->subject_id = $request->subject_id;
        }

        $grading_category->save();

        $fractal = fractal()->item($grading_category, new SubjectGradingCategoryTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Subject Grading Category Show
     *
     * @api {get} <HOST>/api/subject-grading-categories/:id Get Subject Grading Categories
     * @apiVersion 1.0.0
     * @apiName GetSubjectGradingCategories
     * @apiDescription Gets the grading categories a subject specified in {id}.
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     * 
     * @apiParam {Number} id the Subject ID
     *
     * @apiSuccess {Number} id Subject Grading Category ID
     * @apiSuccess {Number} subject_id Subject ID
     * @apiSuccess {String} category_id School Grading Category ID
     * @apiSuccess {String} category_percentage subject grading category percentage (between 0 - 1)
     * 
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 1,
                "subject_id": 1,
                "category_id": "1",
                "category_percentage": "0.25"
            },
            {
                "id": 2,
                "subject_id": 1,
                "category_id": "2",
                "category_percentage": "0.25"
            },
            {
                "id": 4,
                "subject_id": 1,
                "category_id": "4",
                "category_percentage": "0.2"
            }
        ]
     * 
     */
    public function show(Request $request)
    {

        $grading_category = SubjectGradingCategory::whereSubjectId($request->id);

        if(!$grading_category){
            return response('Grading Categories Not Found', 404);            
        }

        $fractal = fractal()->collection($grading_category->get(), new SubjectGradingCategoryTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Subject Grading Category Delete
     *
     * @api {delete} <HOST>/api/subject-grading-category/remove/:id Delete Subject Grading Category
     * @apiVersion 1.0.0
     * @apiName DeleteSubjectGradingCategory
     * @apiDescription Deletes the Subject Grading Category
     * @apiGroup Grading Category
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} id ID of Subject grading category to delete
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function remove(Request $request)
	{
		$user = Auth::user();
		$grading_category = SubjectGradingCategory::find($request->id);

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
