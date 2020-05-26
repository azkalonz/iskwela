<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;

use App\Imports\SchoolDataImport;
use App\Imports\UsersImport;
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
        $school = new School();
        $school->firstOrCreate([
            'school_name' => strtoupper($request->school_name)
        ]);

        $schoolimport = new SchoolDataImport();
        $schoolimport->onlySheets('Teachers', 'Students');

        $results = Excel::import($schoolimport, $request->file);

        dd(get_class_methods($results));
    }
}
