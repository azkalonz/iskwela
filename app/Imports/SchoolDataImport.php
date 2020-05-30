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
use App\Models\AcademicYear;
use App\Models\School;

class SchoolDataImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    var $school = null;
    var $ay = null;

    public function __construct(School $school, AcademicYear $ay)
    {
        $this->school = $school;
        $this->ay = $ay;
    }

    public function conditionalSheets(): array
    {
        return [
            'Year Levels'       => new YearsImport(),
            'Subjects'          => new SubjectsImport(),
            'Teachers'          => new TeachersImport($this->school),
            'SectionsGroups'    => new SectionsImport(),
            'Class Schedule'    => new ClassSchedulesImport($this->ay),
            'Students'          => new StudentsImport($this->school),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
