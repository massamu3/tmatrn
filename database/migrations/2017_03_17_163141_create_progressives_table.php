<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('progressives', function (Blueprint $table) {
        $table->increments('id', true);
        $table->integer('employee_id')->unsigned();
        $table->integer('school_id')->unsigned();
        $table->integer('transaction_id')->unsigned();
        $table->string('remarks');
        $table->string('attach_cert');
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('employee_id')->references('id')->on('employee');
        $table->foreign('transaction_id')->references('id')->on('transaction');
        $table->foreign('school_id')->references('id')->on('school');
       });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progressives');
    }
}
