<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class examsubject extends Model
{
    protected $fillable = ['subject_type'];
    protected $primaryKey = 'id';
    protected $table = 'exam_subject';


}
