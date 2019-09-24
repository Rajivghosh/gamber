<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategoryModel extends Model
{
    protected $table = 'event_category';

    public function screen()
    {
    	return $this->belongsTo('App\Models\GameScreen', 'screen_id', 'id');
    }

    public function level()
    {
    	return $this->belongsTo('App\Models\CompetitionLevelType', 'level_id', 'id');
    }

    public function parent()
    {
    	return $this->belongsTo('App\Models\EventCategoryModel', 'category_parent_id', 'id');
    }

    public function event()
    {
        return $this->hasMany('App\Models\AdminEvent', 'cat_id', 'id');
    }

    public function eventcount()
    {
        return $this->hasMany('App\Models\AdminEvent', 'cat_id', 'id')->where('event_status', '<>', 2);
    }

}
