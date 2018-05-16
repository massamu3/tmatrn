<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('certificates', function (Blueprint $table) {
        $table->integer('employee_id')->unsigned();
        $table->increments('id', true);
        $table->string('gradu_year');
        $table->string('attach_cert');
        $table->string('remarks');
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
        Schema::dropIfExists('certificates');
    }
}

// (Shall upload but neither delete nor update)
//;scanned in single document

         // 