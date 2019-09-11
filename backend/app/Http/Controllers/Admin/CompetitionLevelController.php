<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
//Model File
Use App\Models\GameScreen;
Use App\Models\CompetitionLevelType;
//Form request file (for validation)
use App\Http\Requests\Admin\CompetitionLevelRequest;


class CompetitionLevelController extends Controller
{
	public function index()
	{
        $data = CompetitionLevelType::all();
		return view('admin.competition_level.list', compact('data'));
	}
	public function add()
	{
		$gamescreen = GameScreen::all();
		return view('admin.competition_level.form', compact('gamescreen'));
	}
	public function save(CompetitionLevelRequest $req)
	{
		if(empty($req->input()))
			return response()->json(false);

		$model = CompetitionLevelType::findOrNew($req->input('id'));        
		$model->name = $req->input('type_name');	
		$model->screen_id = $req->input('screen_id');	
		$model->save();
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/competition-level/list');
	}
	public function edit(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$details = CompetitionLevelType::find($req->id);
		$gamescreen = GameScreen::all();
		return view('admin.competition_level.form', compact('details', 'gamescreen'));
	}

	public function remove(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$allow = 1;
        //Write dependency code implement here

        //----------------------------------//
		if ($allow == 1) {            
			CompetitionLevelType::where('id', $req->id)->delete();
		}
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/competition-level/list');
	}
	
}
