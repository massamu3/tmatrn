<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('employees', function (Blueprint $table) {
         $table->increments('id', true);
         $table->string('name_all', 200);
         $table->string('chequeno', 12);
         $table->string('sex', 6);
         $table->date('birthdate');
         $table->date('date_hired');
         $table->integer('designation_id');

         $table->integer('status_id');
         $table->string('schemeservice', 60);
         $table->integer('station_id');
         $table->integer('division_id');
         $table->integer('section_id');
        

         $table->foreign('status_id')->references('id')->on('status');
         $table->foreign('station_id')->references('id')->on('station');
         $table->foreign('division_id')->references('id')->on('division');
         $table->foreign('section_id')->references('id')->on('section');
     
          

         $table->string('picture', 60);
         
         $table->timestamps();
         $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
