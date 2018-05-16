<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademiclevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('academiclevels', function (Blueprint $table) {
        $table->increments('id', true);
        $table->integer('employee_id')->unsigned();
        $table->integer('academic_id')->unsigned(); //Certificate, Diploma, Bachelar, Masters, PHD, Professor
        $table->integer('program_id')->unsigned();
        $table->string('timeperiod');
    
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('employee_id')->references('id')->on('employee');
        $table->foreign('program_id')->references('id')->on('program');
        $table->foreign('academic_id')->references('id')->on('academic');//Long or short course
       });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academiclevels');
    }
}