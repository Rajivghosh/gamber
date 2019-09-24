<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    protected $table = "game_types";

    public function screen()
    {
    	return $this->belongsTo('App\Models\GameScreen', 'screen_id', 'id');
    }
}
