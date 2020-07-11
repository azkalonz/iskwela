<?php

namespace App\Console\Commands;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Schedule;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateClassSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:class-schedules 
    {--school-code= : School Code}
    {--class= : Class name of selected school}
    {--until= : Generate schedules until specific date in Y/m/d format}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates schedules of all classes by given school.';

    protected $school_code = null;
    protected $classes = [];
    protected $date_until = null;

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
        if ($this->option('school-code')) {
            $this->school_code = $this->option('school-code');
        } else {
            $schools = array_column(School::all()->toArray(), 'school_code');
            $this->school_code = $this->anticipate(
                "School is required!",
                $schools
            );
        }

        $target_school = School::where('school_code', $this->school_code)->first();

        if ($this->option('class')) {
            $this->classes[] = Classes::where('name', $this->option('class'))->first();
            $this->info("Target class ".$this->classes[0]->name);
        } else {
            $this->classes = Classes::all();
            $this->info("Targetting all classes.");
        }

        if ($this->option('until')) {
            $this->until = Carbon::createFromFormat('Y/m/d', $this->option('until'));
        } else {
            $ay = AcademicYear::where('school_id', $target_school->id)->first();
            $this->until = Carbon::createFromFormat('Y-m-d', $ay->date_to);
        }

        $total_days = $this->until->diff(Carbon::now())->days + 1;
        $this->info("Generating ".$total_days." total days of schedules...");

        foreach($this->classes as $class) {
            $time_from = explode(':', $class->time_from);
            $time_to = explode(':', $class->time_to);

            for ($i = 0; $i <= $total_days; $i++) { // generate schedules til end of academic year  
                $day_from = Carbon::today()->addDay($i)->setHour($time_from[0])->setMinutes($time_from[1]);
                $day_to = Carbon::today()->addDay($i)->setHour($time_to[0])->setMinutes($time_to[1]);

                if ($day_from->dayOfWeek >= 1 && $day_from->dayOfWeek <= 5) { // generate Mon-Fri only
                    $schedule = Schedule::firstOrCreate([
                        'class_id' => $class->id, // refactor alert! this needs to use Laravel's relationship implementation
                        'teacher_id' => $class->teacher_id,
                        'date_from' => $day_from->format('y-m-d H:i:s'),
                        'date_to' => $day_to->format('y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
