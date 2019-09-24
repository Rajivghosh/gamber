<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game_Status extends Model
{
     protected $table = "game__statuses";


     protected $fillable = [
        'user_id', 'event_id', 'category_id', 'level_id', 'game_id', 'status', 'total_score'
    ];


    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
