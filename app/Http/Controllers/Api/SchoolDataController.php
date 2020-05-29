<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;

use App\Imports\SchoolDataImport;
use App\Models\School;

class SchoolDataController extends Controller
{
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'school_name' => 'required'
        ]);

        // create new or update school
        $school = School::firstOrCreate([
            'school_name' => strtoupper($request->school_name)
        ]);

        $schoolimport = new SchoolDataImport($school);
        $schoolimport->onlySheets(
            'Year Levels',
            'Subjects',
            'Teachers'
            // 'Class Schedule'
            // 'Students'
        );

        $results = Excel::import($schoolimport, $request->file);

        return response()->json($results);
    }
}
