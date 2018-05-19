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
        $table->integer('transaction_id')->unsigned();
        $table->string('attach_cert');
        $table->string('remarks');
        $table->integer('flag')->default(0);
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('transaction_id')->references('id')->on('transaction');

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
