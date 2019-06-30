<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nextLevelSubject extends Model
{
    protected $fillable = ['id','student_id','subject_id','examcode','subject_level'];
    protected $primaryKey = 'id';
    protected $table = 'next_level_subject';


}
