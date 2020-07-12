<?php

namespace App\TransferObjects;

class StudentScoreData extends TransferObjectAbstract
{
    protected $id;
    protected $username;
    protected $first_name;
    protected $last_name;
    protected $scores;

    public function __construct(
        int $id,
        string $username,
        string $first_name,
        string $last_name,
        array $scores)
    {
        $this->id = $id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->scores = $scores;
    }
}
