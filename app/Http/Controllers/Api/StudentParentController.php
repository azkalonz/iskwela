<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\StudentParent;
use \App\Models\User;
use \App\Transformers\StudentParentTransformer;
use \App\Transformers\UserTransformer;

class StudentParentController extends Controller
{
    public function save(Request $request)
    {

        $this->validate($request, [
            'id' => 'integer',
            'parent_id' => 'required|integer',
            'student_id' => 'required|integer'
        ]);

        $user =  Auth::user();

        $parent = User::findOrFail($request->parent_id);

        if($request->id)
        {
            $studentParent = StudentParent::findOrFail($request->id);
            $studentParent->updated_by = $user->updated_by;

        }else
        {
            $studentParent = new StudentParent();
        }

        $studentParent->parent_id = $request->parent_id;
        $studentParent->student_id = $request->student_id;
        $studentParent->created_by = $user->id;
 
        $studentParent->save();
        
        $fractal = fractal()->item($parent, new UserTransformer);

        $fractal->includeChildren();

        return response()->json($fractal->toArray());
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'integer'
        ]);

        if($request->parent_id)
        {
            $parent = User::findOrFail($request->parent_id);
        }else{
            $parent = Auth::user();
        }

        $fractal = fractal()->collection($parent->get(), new UserTransformer);

        $fractal->includeChildren();

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}