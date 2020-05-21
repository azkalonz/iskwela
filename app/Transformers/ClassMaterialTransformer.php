<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ClassMaterialTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['schedules'];

    public function transform(\App\Models\ClassMaterial $class_material)
    {
        return [
            'id' => $class_material->id,
            'title' => $class_material->title,
            'uploaded_file' => ($class_material->filename) ? sprintf('%s/api/download/class/material/%s', env('APP_URL'), $class_material->id) : "",
            'resource_link' => $class_material->link_url,
            'added_by' => [
                'id' => $class_material->user->id,
                'name' => $class_material->user->name,
            ]
        ];
    }
}