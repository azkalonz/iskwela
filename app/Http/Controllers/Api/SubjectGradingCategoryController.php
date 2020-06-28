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
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
