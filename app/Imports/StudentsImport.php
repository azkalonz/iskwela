<?php

namespace App\Imports;

use App\Models\Section;
use App\Models\SectionStudent;

class StudentsImport extends UsersImport
{
    const USER_TYPE = 's';

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        $user = parent::model($row);

        // get section
        $section = Section::whereName($row[7])->first();

        // add student in section
        $section_student = SectionStudent::firstOrCreate([
            'section_id' => $section->id,
            'user_id' => $user->id
        ]);

        return $user;
    }
}
