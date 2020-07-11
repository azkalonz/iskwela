<?php

namespace App\Console\Commands;

use App\Models\AcademicYear;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateNewSchoolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:new-school
    {--code= : School\'s unique code}
    {--name= : School name}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new school';

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
        if ($this->option('code')) {
            $school_code = $this->option('code');
        } else {
            $school_code = $this->ask("School Code required:");
        }

        if(School::where('school_code', $school_code)->first()) {
            $this->error("School with code ".$school_code." already exist.");
            dd();
        }

        if ($this->option('name')) {
            $school_name = $this->option('name');
        } else {
            $school_name = $this->ask("School Name required:");
        }

        $this->info("Creating new school: ");
        $this->info("- School Code: ". $school_code);
        $this->info("- School Name: ". $school_name);

        if ($this->confirm('Continue?')) {
            $school = School::create([
                'school_code' => $school_code,
                'school_name' => $school_name
            ]);

            if($school) {
                $this->info("School created.");

                if ($this->confirm('Add Academic Year?')) {
                    $ayname = $this->ask("Give it a name: ");

                    $ayfrom = $this->ask("Start date (Y/m/d): ");
                    $ayfrom = Carbon::createFromFormat('Y/m/d', $ayfrom);

                    $ayto = $this->ask("End date (Y/m/d): ");
                    $ayto = Carbon::createFromFormat('Y/m/d', $ayto);

                    if($this->confirm( 
                        sprintf("Creating AY `%s` %s - %s", $ayname, $ayfrom->format("Y/m/d"), $ayto->format("Y/m/d")) 
                    )) {
                        $ay = AcademicYear::create([
                            'name' => $ayname,
                            'date_from' => $ayfrom,
                            'date_to' => $ayto,
                            'school_id' => $school->id
                        ]);
                        if($ay) {
                            $this->info("AY created.");
                        }
                    }
                }
            }
        }
    }
}
