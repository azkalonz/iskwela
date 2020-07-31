<?php

use App\Models\Classes;
use App\Models\Section;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FixSectionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Log::info("==== START FIXING INCONSISTENT SECTION SCHOOL INFO ====");
        // get all sections with no school id and it's current school values base from students info
        $sections = DB::table('sections')
            ->join('classes', 'sections.id', '=', 'classes.section_id')
            ->join('users', 'users.id', '=', 'classes.teacher_id')
            ->select('sections.id', 'sections.name', DB::raw('GROUP_CONCAT(DISTINCT users.school_id) AS schools'))
            ->where('sections.school_id', 0)
            ->whereNull('classes.deleted_at')
            ->groupBy("sections.id")
            ->orderBy("schools")
            ->get();

        $sections_with_many_schools = [];
        foreach($sections as $section) {
            Log::info(sprintf("PROCESSING: |%s|", implode("|", (array) $section))  );

            $schools = explode(",", $section->schools);
            $section_model = Section::find($section->id);

            // assume the first school in the list is the correct school
            $section_model->school_id = $schools[0];

            try {
                $section_model->save();
                $section_model = Section::find($section_model->id); // get updated info
                $section->model = $section_model; // new attribute

                Log::info( sprintf("Section %s (%s) is assigned with School %s",
                    $section->model->name,
                    $section->model->id,
                    $section->model->school->id
                ));

                // then remove the first school from the list
                array_shift($schools);
                $section->schools = $schools; // array of school ids

                // for sections with many schools, let's create new records for each
                if (count($schools) >= 1) {
                    $sections_with_many_schools[] = $section;
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        }

        foreach($sections_with_many_schools as $section) {
            foreach ($section->schools as $school_id) {
                // create new section
                $new_section = $section->model->replicate();
                $new_section->school_id = $school_id;
                $new_section->save();
                $new_section = Section::find($new_section->id);
                Log::info( sprintf("New section created: ID %s Name %s School %s",
                    $new_section->id,
                    $new_section->name,
                    $new_section->school->id
                ) );

                // migrate the users of the school to new section
                $section->model->students->each( function($section_student) use ($section, $new_section, $school_id) {
                    $student = $section_student->user;
                    if( $student->school->id == $school_id && $section_student->section_id != $new_section->id) {
                        try {
                            $section_student->section_id = $new_section->id;
                            $section_student->save();
                        
                            Log::info( sprintf("Student %s of school %s has been moved from section %s to section %s",
                                $student->id,
                                $student->school->id,
                                $section->id,
                                $new_section->id
                            ) );
                        } catch (\Throwable $th) {
                            Log::error(sprintf("Unable to move student %s to section %s: %s",
                                $student->id,
                                $new_section->id,
                                $th->getMessage()
                            ));
                        }
                    }
                } );

                // finally, migrate classes to the right section
                $classes = Classes::where('section_id', $section->id)->get();
                $classes->each(function($class) use ($new_section) {
                    if ($class->teacher->school_id !=  $class->section->school_id) {
                        $class->section_id = $new_section->id;
                        $class->save();

                        Log::info( sprintf("Updated class (%s) %s section from %s to %s",
                            $class->id,
                            $class->name,
                            $class->section->id,
                            $new_section->id
                        ));
                    }
                });
            }
        }
        Log::info("==== END FIXING INCONSISTENT SECTION SCHOOL INFO ====");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
