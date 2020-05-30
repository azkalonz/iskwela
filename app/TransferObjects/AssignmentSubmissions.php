<?php

namespace App\TransferObjects;

class AssignmentSubmissions extends TransferObjectAbstract
{
    protected $submissions;

    public function __construct(array $submissions)
    {
        $this->submissions = $submissions;
    }
}
