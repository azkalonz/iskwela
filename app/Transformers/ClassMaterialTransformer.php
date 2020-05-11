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
            'instruction' => $class_material->instruction,
            'description' => $class_material->description,
            'uploaded_file' => $class_material->filename,
            'resource_link' => $class_material->link_url,
            'added_by' => [
                'id' => $class_material->user->id,
                'name' => $class_material->user->name,
            ]
        ];
    }
}