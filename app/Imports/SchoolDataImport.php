<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;  

use App\Imports\YearsImport;
use App\Imports\SubjectsImport;
use App\Imports\TeachersImport;
use App\Imports\SectionsImport;
use App\Imports\ClassSchedulesImport;
use App\Imports\StudentsImport;

use App\Models\School;

class SchoolDataImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    var $school = null;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function conditionalSheets(): array
    {
        return [
            'Year Levels'       => new YearsImport(),
            'Subjects'          => new SubjectsImport(),
            'Teachers'          => new TeachersImport($this->school),
            'Sections/Groups'   => new SectionsImport(),
            'Class Schedule'    => new ClassSchedulesImport(),
            'Students'          => new StudentsImport($this->school),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
