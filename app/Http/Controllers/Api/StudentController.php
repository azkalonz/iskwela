<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\StudentImprovementTransformer;
use Auth;
use App\Models\StudentImprovement;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class StudentController extends Controller
{
    public function addImprovement(Request $request)
    {
		$this->validate($request, [
            'student_id' => 'required|integer',
            'class_id' => 'required|integer'
        ]);

        //$user =  Auth::user();
		
		$student_improvement = StudentImprovement::findOrNew($request->id);
		$student_improvement->student_id = $request->student_id;
		$student_improvement->class_id = $request->class_id;
		$student_improvement->improvement = $request->improvement;
		
        $student_improvement->save();

        $fractal = fractal()->item($student_improvement, new StudentImprovementTransformer);

        return response()->json($fractal->toArray());
    }
	
	public function index(Request $request)
	{
		
	}

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
