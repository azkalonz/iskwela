<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\SectionTransformer;
use Auth;
use App\Models\Section;
use App\Models\Classes;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class SectionController extends Controller
{
	
    public function addStudent(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required|integer',
            'student_id' => 'required|integer'
        ]);

        $student = User::whereId($request->student_id)->whereUserType('s')->firstOrFail();
        $section = Section::findOrFail($request->section_id);

        $section_student = new SectionStudent();
        $section_student->section_id = $request->section_id;
        $section_student->user_id = $request->student_id;
        $section_student->save();

        $fractal = fractal()->item($section, new SectionTransformer);
        $fractal->includeStudents();
        return response()->json($fractal->toArray());

    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'school_id' => 'integer'
        ]);

        $user = Auth::user();

        if($user->user_type == 'su')
        {
            $school_id = $request->school_id ?? $user->school_id;
        }else
        {
            $school_id = $user->school_id;
        }

        $section = Section::whereSchoolId($school_id);

        $fractal = fractal()->collection($section->get(), new SectionTransformer);
        return response()->json($fractal->toArray());
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'year_id' => 'required|integer',
            'name' => 'required',
            'id' => 'integer',
            'school_id' => 'integer'
        ]);

        $user = Auth::user();

        if($user->user_type == 'su')
        {
            $school_id = $request->school_id ?? $user->school_id;
        }
        else{
            $school_id = $user->school_id;
        }

        if($request->id)
        {
            $section = Section::findOrFail($request->id);
        }
        else{
            $section = new Section();
        }

        $section->year_id = $request->year_id ?? $section->year_id;
        $section->name = $request->name ?? $section->name;
        $section->school_id = $school_id ?? $section->school_id;
        $section->save();

        $fractal = fractal()->item($section, new SectionTransformer);
        return response()->json($fractal->toArray());

    }

    public function remove(Request $request)
    {
        $user = Auth::user();
        $section = Section::findOrFail($request->id);

        if($section->school_id != $user->school_id && $user->user_type != 'su')
        {
            return response("Unauthorized", 401);
        }

        $section->delete();

        return response()->json(['success' => true]);

    }
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
