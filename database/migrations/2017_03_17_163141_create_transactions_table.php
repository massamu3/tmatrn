 <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('employee_id')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->integer('academic_id')->unsigned(); //Meteorology, Climate change, Hydrology and Meteorology, Electronic and Telecommunication
            $table->integer('school_id')->unsigned();
            $table->string('status2'); ///
            $table->string('lasttrnperiod'); //string can not be null
            $table->date('startdate');
            $table->date('enddate');
            $table->string('gpa'); //Long or short course
            $table->string('progmode'); //Long or short course
            $table->string('sponsorship');
            $table->string('country');
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
        Schema::dropIfExists('transactions');
    }
}
