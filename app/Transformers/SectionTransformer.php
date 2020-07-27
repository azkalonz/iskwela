<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SectionTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['students'];

    public function transform(\App\Models\Section $section)
    {
        return [
            'id' => $section->id,
            'name' => $section->name,
            'year_id' => $section->year_id
        ];
    }

    public function includeStudents(\App\Models\Section $section)
    {
        return $this->collection($section->students, new \App\Transformers\SectionStudentTransformer);
	}
}