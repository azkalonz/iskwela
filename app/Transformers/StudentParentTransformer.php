<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class StudentParentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['childInfo'];
    public function transform(\App\Models\StudentParent $studentParent)
    {
      return [
              'id' => $studentParent->id,
              'student_id' => $studentParent->student_id
      ];
    }
    
    public function includeChildInfo(\App\Models\StudentParent $studentParent)
    {
        return $this->item($studentParent->childInfo, new \App\Transformers\UserTransformer);
    }
}