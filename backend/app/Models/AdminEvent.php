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

	public function game_stat()
	{
	 	return $this->hasMany('App\Models\Game_Status', 'event_id', 'id')->where('status', 1)->count();
    }

    public function getContestentAttribute()
    {
    	return $this->game_stat();
    }
    public function getBannerAttribute()
    {
        return url('event').'/'.$this->event_banner;
    }
    protected $appends = ['contestent', 'banner'];

    
    // protected $appends = ['banner'];
}
