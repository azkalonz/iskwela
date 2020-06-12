<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;

use App\Imports\SchoolDataImport;
use App\Models\School;
use App\Models\AcademicYear;

class SchoolDataController extends Controller
{
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'school_name' => 'required',
            'school_code' => 'required|unique:schools,school_code',
            'academic_year_name' => 'required',
            'academic_year_from' => 'required|date_format:Y/m/d',
            'academic_year_to' => 'required|date_format:Y/m/d'
        ]);

        $academic_year_from = Carbon::createFromFormat('Y/m/d', $request->academic_year_from);
        $academic_year_to = Carbon::createFromFormat('Y/m/d', $request->academic_year_to);

        // create new or update school
        $school = School::firstOrCreate([
            'school_name' => strtoupper($request->school_name)
        ]);

        // create academic year
        $academic_year = AcademicYear::firstOrCreate([
            'name' => $request->academic_year_name,
            'date_from' => $academic_year_from,
            'date_to' => $academic_year_to,
            'school_id' => $school->id
        ]);

        $schoolimport = new SchoolDataImport($school, $academic_year);
        $schoolimport->onlySheets(
            'Year Levels',
            'Subjects',
            'Teachers',
            'SectionsGroups',
            'Class Schedule',
            'Students'
        );

        $results = Excel::import($schoolimport, $request->file);

        return response()->json($results);
    }
}
