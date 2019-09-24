<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use App\Models\Badges;
use Image;
use File;
//Form request file (for validation)
use App\Http\Requests\Admin\BadgesRequest;

class AdminBadgesController extends Controller
{
	public function index()
	{    	
		$data = Badges::all();
		return view('admin.badges.list', compact('data'));
	}
	public function add()
	{
		return View::make('admin.badges.form');
	}
	public function save(BadgesRequest $req)
	{
		if(empty($req->input()))
			return response()->json(false);

		$model = Badges::findOrNew($req->input('id'));        
		$model->name = $req->input('name');        
		if( $req->hasFile('badges_logo')){ 
			$image = $req->file('badges_logo');
			$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$upload_path = public_path('badges/');
			$img = Image::make($image->getRealPath());
            // resize image
			$img->fit(300, 200);
            // save image
			$upload_path = public_path('badges/');
			$image->move($upload_path, $input['imagename']);
			$model->badges_logo = $input['imagename'];
		}

		$model->save();
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/badges/list');
	}
	public function edit(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$details = Badges::find($req->id);
		return view('admin.badges.form', compact('details'));
	}

	public function remove(Request $req)
	{
		if (empty($req->id))
			return response()->json(false);
		$allow = 1;
        //Write dependency code implement here

        //----------------------------------//
		if ($allow == 1) {
			if(!empty($image->badges_logo)) {
				$image = Badges::where('id', $req->id)->first();
				unlink(public_path().'/badges/' . $image->badges_logo);
			}
			Badges::where('id', $req->id)->delete();
		}
		$req->session()->flash('success', 'Task was successful');
		return redirect('/admin/badges/list');
	}
}
