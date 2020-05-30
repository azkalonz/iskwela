<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AssignmentSubmissionsTransformer extends TransformerAbstract
{
    public function transform(\App\TransferObjects\AssignmentSubmissions $viewers)
    {
        return $submitted_status = $viewers->submissions->map(function($student) {
            $submitted = $student->submittedActivity->count();
            return [
                'first_name' => $student->user->first_name,
                'last_name' => $student->user->last_name,
                'status' => $submitted ? 'DONE' : 'PENDING',
                'date_submitted' => ($student->submittedActivity->first()->created_at) ?? null
            ];
        })->toArray();
    }
}