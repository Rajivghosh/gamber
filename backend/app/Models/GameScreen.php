<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScreen extends Model
{
    protected $table = "game_screen";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_screen_name'];

    public function levels()
    {
    	return $this->hasMany('App\Models\CompetitionLevelType', 'screen_id', 'id');
    }

    public function rules()
    {
        return $this->hasOne('App\Models\GameRule', 'screen_id', 'id');
    }

    public function getLogoAttribute()
    {
        return url('game_logo').'/'.$this->game_logo;
    }
    protected $appends = ['logo'];
}
