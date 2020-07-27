<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\SectionStudentTransformer;
use App\Transformers\SectionTransformer;
use Auth;
use App\Models\SectionStudent;
use App\Models\Section;
use App\Models\Classes;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class SectionStudentController extends Controller
{
	
    public function add(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required|integer',
            'student_id' => 'required|integer'
        ]);

        $section = Section::findOrFail($request->section_id);

        $section_student = new SectionStudent();
        $section_student->section_id = $request->section_id;
        $section_student->user_id = $request->student_id;
        $section_student->save();

        $fractal = fractal()->item($section, new SectionTransformer);
        $fractal->includeStudents();
        return response()->json($fractal->toArray());

    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
