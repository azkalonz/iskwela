<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireQuestion extends Model
{
    public $timestamps = false;
    protected $fillable = [
            'questionnaire_id',
            'question_id',
            'weight'
    ];
}
