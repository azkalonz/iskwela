<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
{
    protected $table = 'quizzes_questions';
    public $timestamps = false;
    protected $fillable = [
            'quiz_id',
            'question_id',
            'weight'
    ];
}
