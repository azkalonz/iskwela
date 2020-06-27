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
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
