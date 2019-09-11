<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminVenue extends Model
{
    protected $table = "venue";


    protected $fillable = ['screen_id', 'name', 'code'];


    public function screen()
    {
    	return $this->belongsTo('App\Models\GameScreen', 'screen_id', 'id');
    }
}
