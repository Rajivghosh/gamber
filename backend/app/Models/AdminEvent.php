<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminEvent extends Model
{
	protected $table = 'game_event';

	public function category()
	{
		return $this->belongsTo('App\Models\EventCategoryModel', 'cat_id', 'id');
	}

	public function game_venue()
	{
		return $this->belongsTo('App\Models\AdminVenue', 'venue', 'id');
	}

	public function type()
	{
		return $this->belongsTo('App\Models\GameType', 'game_type', 'id');
	}

	public function screen()
	{
		return $this->belongsTo('App\Models\GameScreen', 'event_type', 'id');
	}
}
