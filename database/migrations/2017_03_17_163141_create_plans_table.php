<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('plans', function (Blueprint $table) {
        $table->increments('id', true);
        $table->integer('employee_id')->unsigned();
        $table->integer('program_id')->unsigned(); //Meteorology, Climate change, Hydrology and Meteorology, Electronic and Telecommunication
        $table->string('startdate'); //Plan is made when to study
        $table->string('progmod'); //can be short or long
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('employee_id')->references('id')->on('employee');
        $table->foreign('program_id')->references('id')->on('program');
 
       });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}



