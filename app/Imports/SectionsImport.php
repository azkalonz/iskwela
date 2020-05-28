<?php

namespace App\Imports;

use App\Models\Section;
use App\Models\Year;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SectionsImport implements ToModel, WithStartRow, WithCalculatedFormulas
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
    * @return Section|null
     */
    public function model(array $row)
    {
        // get Year first
        $year = Year::whereName($row[1])->first();

        return Section::firstOrCreate([
            'name'    => $row[0],
            'year_id'   => $year->id
        ]);
    }
}
