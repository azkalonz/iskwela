<?php

namespace App\TransferObjects;

class ActivityScoreData extends TransferObjectAbstract
{
    protected $id;
    protected $published_at;
    protected $title;
    protected $perfect_score;
    protected $total_score;
    protected $rating;

    public function __construct(
        int $id,
        string $published_at,
        string $title,
        int $perfect_score,
        int $total_score,
        double $rating)
    {
        $this->id = $id;
        $this->published_at = $published_at;
        $this->title = $first_name;
        $this->perfect_score = $perfect_score;
        $this->total_score = $total_score;
        $this->rating = $rating;
    }
}
