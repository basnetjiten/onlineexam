<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = ['student_id', 'examcode', 'examattempt'];
    protected $table = 'exam_attempts';
}
