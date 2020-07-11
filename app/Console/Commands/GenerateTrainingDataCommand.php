<?php

namespace App\Console\Commands;

use App\Models\Classes;
use App\Models\School;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;
use Illuminate\Console\Command;

class GenerateTestDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:training-data
    {--school= : School Code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates test users, section, and class of a school.
    NOTE: This doesn\'t generate class schedules. Use `generate:class-schedules` for that';

    /**
     * The school code
     * 
     * @var string 
     */
    protected $school_code = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get school info
        if ($this->option('school')) {
            $this->school_code = $this->option('school');
        } else {
            $schools = array_column(School::all()->toArray(), 'school_code');
            $this->school_code = $this->anticipate(
                "School is required!",
                $schools
            );
        }

        $target_school = School::where('school_code', $this->school_code)->first();

        if(!$target_school) {
            dd("Invalid school!");
        }

        $prefix = strtolower($target_school->school_code);

        // generate 1 test teacher
        $teacher = User::updateOrCreate([
            'username' => $prefix.".trainingteacher"
        ],[
            'username'      => $prefix.".trainingteacher",
            'first_name'    => "Training",
            'middle_name'   => "",
            'last_name'     => "Teacher",
            'gender'        => ' ',
            'phone_number'  => null,
            'email'         => null,
            'user_type'     => 't',
            'password'      => $prefix.".trainingteacher",
            'school_id'     => $target_school->id
        ]);
        $this->info("TEACHER ".$teacher->username." / ".$prefix.".trainingteacher");

        // generate 10 test students
        for($i=1; $i<=10; $i++) {
            $student = User::updateOrCreate([
                'username' => $prefix.".trainingstudent".$i
            ],[
                'username'      => $prefix.".trainingstudent".$i,
                'first_name'    => "Training",
                'middle_name'   => "",
                'last_name'     => "Student".$i,
                'gender'        => " ",
                'phone_number'  => null,
                'email'         => null,
                'user_type'     => 's',
                'password'      => $prefix.".trainingstudent".$i,
                'school_id'     => $target_school->id
            ]);
            $this->info("STUDENT ".$student->username." / ".$prefix.".trainingstudent".$i);
        }

        // generate training Subject
        $subject = Subject::updateOrCreate([
            'name'    => "Training Subject"
        ]);
        $this->info("SUBJECT ".$subject->name);

        // generate Training Year Grade 1
        $year = Year::updateOrCreate([
            'name'    => "Training Year 1"
        ]);
        $this->info("YEAR ".$year->name);

        // generate 1 section
        $section = Section::updateOrCreate([
            'name' => strtoupper($prefix)." Training Section"
        ],[
            'name'    => strtoupper($prefix)." Training Section",
            'year_id'   => $year->id
        ]);
        $this->info("SECTION ".$section->name);

        // generate 1 class
        $class = Classes::updateOrCreate([
            'name' => strtoupper($prefix)." Training Class"
        ],[
            'name' => strtoupper($prefix)." Training Class",
            'year_id' => $year->id,
            'teacher_id' => $teacher->id,
            'created_by' => $teacher->id,
            'updated_by' => $teacher->id,
            'subject_id' => $subject->id,
            'section_id' => $section->id,
            'frequency' => 'daily',
            'time_from' => "08:00:00",
            'time_to' => "09:00:00",
            'color' => config("school_hub.colors.iSkwela Purple"),
            'room_number' => strtoupper($prefix)."TrainingRoom"
        ]);
        $this->info("CLASS ".$class->name);
    }
}
