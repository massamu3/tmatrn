<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'station';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function employees() {
        return $this->hasMany('App\Employee', 'station_id', 'id');
    }
}
