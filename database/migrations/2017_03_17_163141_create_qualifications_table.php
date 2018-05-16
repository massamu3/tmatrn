<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('qualifications', function (Blueprint $table) {
         $table->increments('id', true);
         $table->integer('employee_id')->unsigned();
         $table->string('graduatedate');
         $table->string('gpa'); //upersecond lower second etc
         $table->string('remarks'); ///
         $table->timestamps();
         $table->softDeletes();
         $table->foreign('employee_id')->references('id')->on('employee');
       });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
}

