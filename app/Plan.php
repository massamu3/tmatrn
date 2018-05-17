<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


      public function employees() {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }


         public function programs() {
        return $this->belongsTo('App\Program', 'program_id', 'id');
    }



}

// employee_id program_id  startdate   progmod pcost