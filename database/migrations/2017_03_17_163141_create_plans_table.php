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
        $table->integer('program_id')->unsigned(); //Masters, Bachelar, Certificate, Diploma
        $table->integer('academic_id')->unsigned(); //Meteorology, Climate change, Hydrology and Meteorology, Electronic and Telecommunication
        $table->integer('school_id')->unsigned();
        
        $table->string('startdate', 12); //madae when to study Financial year
        $table->string('progmod', 20);
        $table->string('ifattend',20);
        $table->decimal('pcost', 16, 2);
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('employee_id')->references('id')->on('employee');
        $table->foreign('program_id')->references('id')->on('program');
        $table->foreign('school_id')->references('id')->on('school');
        $table->foreign('academic_id')->references('id')->on('academic');
 
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





