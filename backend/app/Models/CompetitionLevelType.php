<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionLevelType extends Model
{
    protected $table = "competition_level_type";

    public function screen()
    {
    	return $this->belongsTo('App\Models\GameScreen', 'screen_id', 'id');
    }
}
