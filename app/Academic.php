<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Academic';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
