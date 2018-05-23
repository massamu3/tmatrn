<?php

namespace App; // Hii ni ile ya kubadilisha ID kwenye index.ple iwe maneno

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $table = 'employees';
    protected $guarded = [];

    public function stations() {
    	return $this->belongsTo('App\Station', 'station_id', 'id');
    }


     public function divisions() {
        return $this->belongsTo('App\Division', 'division_id', 'id');
    }

}
