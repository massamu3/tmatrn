<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progressive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'progressives';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


    public function employees() {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }


    public function transactions() {
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }


}