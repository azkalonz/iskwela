<?php

namespace App\Imports;

use App\Models\Year;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class YearsImport implements ToModel, WithStartRow
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
     * @return Year|null
     */
    public function model(array $row)
    {
        return Year::firstOrCreate([
            'name'    => $row[0]
        ]);
    }
}
