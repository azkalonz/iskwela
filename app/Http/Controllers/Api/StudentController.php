<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\StudentImprovementTransformer;
use Auth;
use App\Models\StudentImprovement;
use App\Models\Classes;

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
		
		$student_improvement = StudentImprovement::findOrNew($request->id);
		$student_improvement->student_id = $request->student_id;
		$student_improvement->class_id = $request->class_id;
		$student_improvement->improvement = $request->improvement;

        $student_improvement->save();
		
		$classes = Classes::select(['classes.id'
									, 'classes.name'
									,'users.id as student_id'
									,'users.first_name'
									,'users.last_name'
									, 'students_improvements.improvement'])
			->whereClassId($request->class_id)
			->join('sections_students', 'sections_students.section_id', '=', 'classes.section_id')
			->join('users', 'users.id', '=', 'sections_students.user_id')
			->leftJoin('students_improvements', function($join)
						{
							$join->on('students_improvements.student_id', '=', 'users.id');
							$join->on('students_improvements.class_id', '=', 'classes.id');
						})
			->where('users.id','=',$request->student_id);

        $fractal = fractal()->item($classes->first(), new StudentImprovementTransformer);

        return response()->json($fractal->toArray());
    }
	
	public function studentImprovement(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'integer'
        ]);

        $user =  Auth::user();

		$classes = Classes::select(['classes.id'
									, 'classes.name'
									,'users.id as student_id'
									,'users.first_name'
									,'users.last_name'
									, 'students_improvements.improvement'])
			->whereTeacherId($user->id)
			->join('sections_students', 'sections_students.section_id', '=', 'classes.section_id')
			->join('users', 'users.id', '=', 'sections_students.user_id')
			->leftJoin('students_improvements', function($join)
						{
							$join->on('students_improvements.student_id', '=', 'users.id');
							$join->on('students_improvements.class_id', '=', 'classes.id');
						});

		if($request->class_id)
		{
			$classes->where('classes.id', '=', $request->class_id);
		}

        $fractal = fractal()->collection($classes->get(), new StudentImprovementTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
