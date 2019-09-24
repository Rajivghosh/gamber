<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
//Model File
Use App\Models\GameScreen;
Use App\Models\GameType;
//Form request file (for validation)
use App\Http\Requests\Admin\GameTypeRequest;


class GameTypeController extends Controller
{
	public function index()
	{
        $data = GameType::all();
		return view('admin.game_type.list', compact('data'));
	}
	public function add()
	{
		$gamescreen = GameScreen::all();
		return view('admin.game_type.form', compact('gamescreen'));
	}
	public function save(GameTypeRequest $req)
	{
		// dd( $req->input('game_type_id'));
		if(empty($req->input()))
			return response()->json(false);

		$model = GameType::findOrNew($req->input('id')); 
		if($req->input('game_type_id') == 0)
		{       
			$model->name = $req->input('type_name');	
			$model->screen_id = $req->input('screen_id');
			$model->save();
		}
		else
		{
			$model->name = $req->input('type_name');	
			$model->screen_id = $req->input('screen_id');
			$model->game_entry_type = $req->input('game_type_id');	
			$model->save();
		}
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/game_type/list');
	}
	public function edit(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$details = GameType::find($req->id);
		$gamescreen = GameScreen::all();
		return view('admin.game_type.form', compact('details', 'gamescreen'));
	}

	public function remove(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$allow = 1;
        //Write dependency code implement here

        //----------------------------------//
		if ($allow == 1) {            
			GameType::where('id', $req->id)->delete();
		}
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/game_type/list');
	}
	
}
