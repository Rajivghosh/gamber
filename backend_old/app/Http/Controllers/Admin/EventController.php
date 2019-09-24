<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
Use Auth;
use Image;
use File;
Use App\Models\GameScreen;
Use App\Models\CompetitionLevelType;
Use App\Models\EventCategoryModel;
Use App\Models\AdminEvent;
use App\Models\AdminVenue;
use App\Models\GameType;
//Form request file (for validation)
use App\Http\Requests\Admin\EventRequest;

class EventController extends Controller
{
    public function index()
    {
        $data = AdminEvent::all();
        return View::make('admin.event.list', compact('data'));
    }

    public function add()
    {
        $gamescreen = GameScreen::all();		
        $venue = AdminVenue::all(); 
        return view('admin.event.form', compact('gamescreen','venue'));
    }

   public function save(EventRequest $req)
    {
    	// dd($req->all());
        //Event Level
        $level = CompetitionLevelType::where('id', $req->input('level_screen_id'))->first();
        $event_level = $level->name;

        //Prize Money
        if($event_level == 'Friendly')
        {
            $prize = 'Free';
        }
        else
        {
            $prize = '$'.$req->input('win_prize');    
        }
    	
    	//Game Name
    	$screen = GameScreen::where('id', $req->input('screen_id'))->first();
    	$game_name = $screen->game_screen_name;

    	//Game Type
    	$type = GameType::where('id', $req->input('game_type'))->first();
    	$game_type_array = explode(' ', $type->name);
    	$type_acronym = "";
    	foreach ($game_type_array as $w) {
          $type_acronym .= $w.'-';
        }
        $game_type = strtoupper($type_acronym);

    	//Event Title
        $event_title_array = explode(" ", $req->input('event_title'));
        $event_title_acronym = "";
        foreach ($event_title_array as $w) {
          $event_title_acronym .= $w[0];
        }
        $event_title = strtoupper($event_title_acronym);

        //Event Venue
        $venue = AdminVenue::where('id', $req->input('event_venue'))->first();
        $event_venue = $venue->code;


        //Event Category
        $category = EventCategoryModel::where('id', $req->input('cat_name'))->first();
        $event_category = $category->code;

        
        
        if($event_category=='TRNY')
        {
        	//Event Tournament
        	$tounament = EventCategoryModel::where('id', $req->input('event_sub_cat'))->first();
        	$event_tournament_array = explode('-', $tounament->name);
        	$event_tournament = $event_tournament_array[1].'TM';
        	$generate_name = $prize.' '.$game_name.'-'.$game_type.$event_tournament.'-'.$event_title.'-'.$event_venue.'-'.$event_category;	
        }
        else
        {
        	$generate_name = $prize.' '.$game_name.'-'.$game_type.$event_title.'-'.$event_venue.'-'.$event_category;
        }
        
        // dd($generate_name);
        if(empty($req->input()))
            return response()->json(false);
        $model = AdminEvent::findOrNew($req->input('id'));        
        $model->title = $req->input('event_title'); 
        $model->gen_title = $generate_name; 
        $model->cat_id = $req->input('event_sub_cat');
        $model->event_type = $req->input('screen_id');   
        $model->game_type = $req->input('game_type'); 
        $model->venue = $req->input('event_venue'); 
        $model->control_type = $req->input('event_control_type'); 
        $model->match_length = $req->input('match_length');
        $model->win_prize = $req->input('win_prize');
        $model->entry_fees = $req->input('entry_fees');   
        $model->total_entries = 0; 
        $model->prize_pool = '';
        $model->event_duration = $req->input('event_duration'); 
        $model->event_sponson = $req->input('event_sponsor');
        $model->event_rule = $req->input('event_rules');   
        $model->event_start_date = $req->input('event_start_date'); 
        $model->event_end_date = $req->input('event_end_date'); 
        $model->event_status = 0; 
        if( $req->hasFile('event_banner')) { 
            $image = $req->file('event_banner');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $upload_path = public_path('event/');
            $img = Image::make($image->getRealPath());
            // resize image
            $img->fit(800, 400);
            // save image
            $upload_path = public_path('event/');
            $image->move($upload_path, $input['imagename']);
            $model->event_banner = $input['imagename'];
        }
        $model->save();
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/event/list');
    }

    public function remove(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $allow = 1;
        //Write dependency code implement here

        //----------------------------------//
        if ($allow == 1) {            
            AdminEvent::where('id', $req->id)->delete();
        }
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/event/list');
    }   

    public function listlevelById(Request $req)
    {
        $levedata = CompetitionLevelType::where('screen_id', $req->screen_id)->get();
        return view('admin.event.ajax_fetch_competition_level', compact('levedata'));     
    }

    public function listvenueById(Request $req)
    {
        // echo $req->id;
        // // exit;
        $venuedata = AdminVenue::where('screen_id', $req->id)->get();
        return view('admin.event.ajax_fetch_venue', compact('venuedata'));     
    }


    public function listgametypeById(Request $req)
    {
        // echo $req->id;
        // // exit;
        $gametypedata = GameType::where('screen_id', $req->id)->get();
        return view('admin.event.ajax_fetch_game_type', compact('gametypedata'));     
    }

    public function listcatById(Request $req)
    {
        $catdata = EventCategoryModel::where('level_id', $req->level_screen_id)->where('category_parent_id', 0)->get();
        return view('admin.event.ajax_fetch_category', compact('catdata'));
    }

    public function listsubcatbyID(Request $req)
    {
        $subcatdata = EventCategoryModel::where('category_parent_id',$req->cat_id)->get();
        return view('admin.event.ajax_fetch_subcat', compact('subcatdata'));
    }

    public function edit(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = AdminEvent::find($req->id);
        $venue = AdminVenue::all(); 
        $gamescreen = GameScreen::all();
        $gametypedata = GameType::where('screen_id', $req->id)->get();
        return view('admin.event.form', compact('details', 'gamescreen', 'venue','gametypedata'));
    }

    public function details(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = EventCategoryModel::find($req->id);
        $gamescreen = GameScreen::all();
        return view('admin.event.event_details', compact('details', 'gamescreen'));
    }
}
