<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsubjectTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_subject', function (Blueprint $table) {
            
                  $table->increments('subject_id');
                  $table->string('examcode');
                  $table->string('subject',100);
                  $table->string('subject_level',100);
                  $table->integer('pass_mark',100);
                  $table->string('subject_type',10);
                  $table->string('admin_id',100);
                  $table->string('admin_email',100);
            $table->foreign('examcode')->references('examcode')->on('exam')->onDelete('cascade');

            $table->timestamps();
            
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_subject');
    }
}
