<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ClassMaterialTransformer extends TransformerAbstract
{
    public function transform(\App\Models\ClassMaterial $class_material)
    {
        return [
            'id' => $class_material->id,
            'title' => $class_material->title,
            'uploaded_file' => ($class_material->filename) ? sprintf('%s/api/download/class/material/%s', env('APP_URL'), $class_material->id) : "",
            'resource_link' => $class_material->link_url,
            'added_by' => [
                'id' => $class_material->user->id,
                'first_name' => $class_material->user->first_name,
                'last_name' => $class_material->user->last_name,
            ],
            'status' => config('school_hub.file_status')[$class_material->published],
            'done' => config('school_hub.boolean_return')[$class_material->done]
        ];
    }
}