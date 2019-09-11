<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GameScreen;
use App\Models\AdminVenue;
use Auth;
use View;
use App\Http\Requests\Admin\VenueRequest;

class AdminVenueController extends Controller
{
    public function index()
    {
        $data = AdminVenue::all();
        return view('admin.venue.list', compact('data'));
    }

    public function add()
    {
        $gamescreen = GameScreen::all();
        return View::make('admin.venue.form', compact('gamescreen'));
    }

    public function save(VenueRequest $req)
    {
        if(empty($req->input()))
            return response()->json(false);

        $model = AdminVenue::findOrNew($req->input('id'));
        $model->name = $req->input('name');
        $model->code = strtoupper($req->input('code'));
        $model->screen_id = $req->input('screen_id');
        $model->save();
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/venue/list');
    }

    public function edit(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = AdminVenue::find($req->id);
        $gamescreen = GameScreen::all();
        return view('admin.venue.form', compact('details','gamescreen'));
    }

    public function remove(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $allow = 1;
        //Write dependency code implement here
    
        //----------------------------------//
        if ($allow == 1) {            
            AdminVenue::where('id', $req->id)->delete();
        }
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/venue/list');
    }
}
