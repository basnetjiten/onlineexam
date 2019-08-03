<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addquestion extends Model
{
    protected $fillable = ["question",
        "option_A",
        "option_B",
        "option_C",
        "option_D",
        "marks",
        "qdifficulty",
        "category",
        "examcode",
        "subject_code",
        "subject",
        "image",
        "imageA",
        "imageB",
        "imageC",
        "imageD",
        "negative_marks",
        "admin_email",
        "admin_id",
        "correct_option",
        "level"];
    protected $table = 'exam_question';

    protected $guarded = [];
}
