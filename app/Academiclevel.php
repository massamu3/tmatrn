<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academiclevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'academiclevels';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


      public function employees() {

    return $this->belongsTo('App\Employee', 'lastname','firstname','middlename','id');
    }


        public function programs() {
        return $this->belongsTo('App\Program', 'program_id', 'id');
    }


         public function academics() {
        return $this->belongsTo('App\School', 'academic_id', 'id');
    }
}