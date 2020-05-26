<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;  

use App\Imports\TeachersImport;
use App\Imports\StudentsImport;

class SchoolDataImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Supported Data' => null,
            'Teachers' => new TeachersImport(),
            'Students' => new StudentsImport(),
            // 'Sections/Groups' => new SectionsImport(),
            // 'Class Schedule' => new ClassSchedulesImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
