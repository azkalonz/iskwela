<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;

use App\Imports\SchoolDataImport;
use App\Models\School;
use App\Models\AcademicYear;

class SchoolDataController extends Controller
{
    use File;

    public function import(Request $request)
    {
        try {
            $this->validate($request, [
                'file' => 'required',
                'school_name' => 'string',
                'school_code' => 'required',
                'school_logo' => 'file|image',
                'academic_year_name' => 'required_with:academic_year_from,academic_year_to',
                'academic_year_from' => 'required_with:academic_year_name,academic_year_to|date_format:Y/m/d',
                'academic_year_to' => 'required_with:academic_year_name,academic_year_from|date_format:Y/m/d'
            ]);

            // create new or get school
            $school = School::where('school_code', '=', strtoupper($request->school_code))->first();
            if (!$school) {
                $school = School::create([
                    'school_name' => $request->school_name,
                    'school_code' => strtoupper($request->school_code)
                ]);
            }

            if (isset($request->school_logo)) {
                // upload logo to new root path
                $logo_path = $this->uploadToPublicSpace($request->school_logo, $school->school_code);

                // update school's logo
                $school->school_logo = $logo_path;
                $school->save();
            }

            // create academic year if set or get the first record
            if($request->academic_year_name) {
                $academic_year_from = Carbon::createFromFormat('Y/m/d', $request->academic_year_from);
                $academic_year_to = Carbon::createFromFormat('Y/m/d', $request->academic_year_to);
                $academic_year = AcademicYear::create([
                    'name' => $request->academic_year_name,
                    'date_from' => $academic_year_from,
                    'date_to' => $academic_year_to,
                    'school_id' => $school->id
                ]);
            } else {
                $academic_year = AcademicYear::whereSchoolId($school->id)->first();

                if(!$academic_year) {
                    return response()->error("At least one Academic Year should exist for the school.");
                }
            }

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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
