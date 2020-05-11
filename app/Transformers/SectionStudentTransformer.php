<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SectionStudentTransformer extends TransformerAbstract
{
    public function transform(\App\Models\SectionStudent $section_student)
    {
        return [
            'id' => $section_student->user->id,
            'name' => $section_student->user->name,
            'user_type' => $section_student->user->user_type,
        ];
    }
}