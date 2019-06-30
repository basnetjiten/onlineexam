<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = ['student_id', 'examcode', 'subject_level','examattempt','subject_id','subject_passed'];
    protected $table = 'exam_attempts';
}
