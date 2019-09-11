<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
//Model File
Use App\Models\GameScreen;
Use App\Models\CompetitionLevelType;
Use App\Models\EventCategoryModel;
//Form request file (for validation)
use App\Http\Requests\Admin\EventCategoryRequest;

class EventCategoryController extends Controller
{
	public function index(){
		$data = EventCategoryModel::where('category_parent_id', 0)->get();
		return view('admin.eventcategory.list', compact('data'));
	}

	public function add()
	{
		$gamescreen = GameScreen::all();
		return view('admin.eventcategory.form', compact('gamescreen'));
		
	}
	public function save(EventCategoryRequest $req)
	{
		if(empty($req->input()))
			return response()->json(false);

		$model = EventCategoryModel::findOrNew($req->input('id'));        
		$model->name = $req->input('cat_name');	
		$model->code = strtoupper($req->input('cat_code'));	
		$model->details = $req->input('cat_details');
		$model->screen_id = $req->input('screen_id');	
		$model->category_parent_id = 0;	
		$model->level_id = $req->input('level_screen_id');	

		$model->save();
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/eventcategory/list');
	}
	public function edit(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$details = EventCategoryModel::find($req->id);
		$gamescreen = GameScreen::all();
		return view('admin.eventcategory.form', compact('details', 'gamescreen'));
	}
	public function remove(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$allow = 1;
        //Write dependency code implement here

        //----------------------------------//
		if ($allow == 1) {            
			EventCategoryModel::where('id', $req->id)->delete();
		}
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/eventcategory/list');
	}
	public function listlevelById(Request $req){
		$data = CompetitionLevelType::where('screen_id', '=',$req->screen_id)->get();
		return view('admin.eventcategory.ajax_fetch_competition_level', compact('data'));     

	}
}
