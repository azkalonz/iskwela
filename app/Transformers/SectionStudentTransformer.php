<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SectionStudentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    public function transform(\App\Models\SectionStudent $section_student)
    {
        return [];
    }

    public function includeUser(\App\Models\SectionStudent $section_student)
    {
        return $this->item($section_student->user, new \App\Transformers\UserTransformer);
    }
}