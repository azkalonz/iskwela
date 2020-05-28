<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Year;
use App\Models\User;
use App\Models\Section;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ClassSchedulesImport implements ToModel, WithStartRow, WithCalculatedFormulas
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
    * @return Classes|null
     */
    public function model(array $row)
    {
        $subject = Subject::whereName($row[1])->first();
        $year = Year::whereName($row[2])->first();
        $section = Section::whereName($row[3])->first();
        $teacher = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), "=", $row[4])->first();

        return Classes::firstOrCreate([
            'name' => $row[0],
            'year_id' => $year->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'section_id' => $section->id,
            'time_from' => $row[6],
            'time_to' => $row[7],
            'color' => $this->generateRandomColor(),
            'room_number' => $this->generateRoom()
        ]);
    }

    private function generateRandomColor()
    {
        return "#"
            . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) 
            . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) 
            . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    private function generateRoom()
    {
        return Str::random(32);
    }
}
