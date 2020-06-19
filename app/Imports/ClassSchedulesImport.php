<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Year;
use App\Models\User;
use App\Models\Section;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ClassSchedulesImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    var $ay = null;

    public function __construct(AcademicYear $ay)
    {
        $this->ay = $ay;
    }
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

        $class = Classes::firstOrCreate([
            'name' => $row[0],
            'year_id' => $year->id,
            'teacher_id' => $teacher->id,
            'created_by' => $teacher->id,
            'updated_by' => $teacher->id,
            'subject_id' => $subject->id,
            'section_id' => $section->id,
            'frequency' => $row[5],
            'time_from' => Carbon::instance(Date::excelToDateTimeObject($row[6]))->format('H:i:s'),
            'time_to' => Carbon::instance(Date::excelToDateTimeObject($row[7]))->format('H:i:s'),
            'color' => $this->generateRandomColor(),
            'room_number' => $this->generateRoom()
        ]);

        // generate class schedules from today til end of academic year
        $schedules = $this->createClassSchedules($class, $teacher);

        return $class;
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

    private function createClassSchedules(Classes $class, User $teacher)
    {
        $time_from = explode(':', $class->time_from);
        $time_to = explode(':', $class->time_to);
        $total_days = $this->ay->date_to->diff(Carbon::now())->days + 1;

        for($i=0; $i <= $total_days; $i++) { // generate schedules til end of academic year  
            $day_from = Carbon::today()->addDay($i)->setHour($time_from[0])->setMinutes($time_from[1]);
            $day_to = Carbon::today()->addDay($i)->setHour($time_to[0])->setMinutes($time_to[1]);

            if ($day_from->dayOfWeek >= 1 && $day_from->dayOfWeek <= 5 ) { // generate Mon-Fri only
                $schedule = Schedule::firstOrCreate([
                    'class_id' => $class->id, // refactor alert! this needs to use Laravel's relationship implementation
                    'teacher_id' => $teacher->id,
                    'date_from' => $day_from->format('y-m-d H:i:s'),
                    'date_to' => $day_to->format('y-m-d H:i:s'),
                ]);
            }

        }
    }
}
