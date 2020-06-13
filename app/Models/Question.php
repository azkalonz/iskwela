<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    const TYPE_MCQ = 'mcq';
    use SoftDeletes;
    protected $fillable = [
        'question',
        'question_type',
        'question_image',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'answer_5'
    ];

    public function mapping()
    {
        // todo: recheck this. It will be bug if question is reused by other quiz 
        // (which becomes one question -> many mapping)
        return $this->hasOne(QuizQuestion::class, 'question_id');
    }
}
