<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentMaterialTransformer extends TransformerAbstract
{
    public function transform(\App\Models\AssignmentMaterial $assignment_material)
    {
        return [
            'id' => $assignment_material->id,
            'uploaded_file' => ($assignment_material->file) ? sprintf('%s/api/download/activity/material/%s', env('APP_URL'), $assignment_material->id) : "",
            'resource_link' => $assignment_material->link_url
        ];
    }
}