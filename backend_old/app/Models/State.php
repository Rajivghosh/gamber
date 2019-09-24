<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";

    protected $fillable = [
        'country_id', 'state_name'
    ];


    public function country()
    {
    	return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function city()
    {
    	return $this->hasMany('App\Models\City', 'state_id', 'id');
    }
}