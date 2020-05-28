<?php

namespace App\Imports;

use App\Models\Subject;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SubjectsImport implements ToModel, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return Subject|null
     */
    public function model(array $row)
    {
        return Subject::firstOrCreate([
            'name'    => $row[0]
        ]);
    }
}
