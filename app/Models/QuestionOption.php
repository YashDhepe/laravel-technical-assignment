<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $fillable = ['option'];

    public function quizQuestion()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
