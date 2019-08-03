<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAbility extends Model
{
    protected $fillable = ['student_id','subject_id','pability','abilityright','se'];
    protected $table = 'student_ability';
   //// protected $primaryKey = 'id';

}
