<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = "user_info";

    protected $fillable = [
        'user_id', 'dob', 'dob_verified', 'first_name', 'last_name', 'contact_no', 'address', 'country', 'state', 'city', 'zipcode'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function setDobAttribute($value)
    {
    	$this->attributes['dob'] = date('Y-m-d', strtotime($value));
    }
}
