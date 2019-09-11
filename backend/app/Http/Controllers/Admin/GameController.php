<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
use Image;
use File;
//Model File
Use App\Models\GameScreen;
Use App\Models\GameSetting;
Use App\Models\GameRule;
//Form request file (for validation)
use App\Http\Requests\Admin\GameRequest;
use App\Http\Requests\Admin\GameRuleRequest;

class GameController extends Controller
{
    public function index()
    {
        $data = GameScreen::all();
        return view('admin.game.list', compact('data'));
    }

    public function add()
    {
        return View::make('admin.game.form');
    }

    public function save(GameRequest $req)
    {
        if(empty($req->input()))
            return response()->json(false);
        $model = GameScreen::findOrNew($req->input('id'));
        $model->game_screen_name = $req->input('name');
        $model->game_slug = str_slug($req->input('name'));
        if( $req->hasFile('game_logo')){ 
            $image = $req->file('game_logo');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $upload_path = public_path('game_logo/');
            $img = Image::make($image->getRealPath());
            // resize image
            $img->fit(300, 200);
            // save image
            $upload_path = public_path('game_logo/');
            $image->move($upload_path, $input['imagename']);
            $model->game_logo = $input['imagename'];
        }
        
        $model->save();
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/game/list');
    }

    public function edit(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = GameScreen::find($req->id);
        return view('admin.game.form', compact('details'));
    }

    public function remove(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $allow = 1;
        //Write dependency code implement here

        //----------------------------------//
        if ($allow == 1) {
            if(!empty($image->game_logo)) {
                $image = GameScreen::where('id', $req->id)->first();
                unlink(public_path().'/game_logo/' . $image->game_logo);
            }
            GameScreen::where('id', $req->id)->delete();
        }
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/game/list');
    }

    public function settings(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = GameScreen::find($req->id);

        if($details->game_slug=='fifa') {
            $fifa = GameSetting::where('screen_id', $req->id)->pluck('game_setting_value', 'game_setting_key')->toArray();
            return view('admin.game.fifa_setting', compact('details','fifa'));
        }
        if($details->game_slug=='nba2k') {
            $nba2k = GameSetting::where('screen_id', $req->id)->pluck('game_setting_value', 'game_setting_key')->toArray();
            return view('admin.game.nba2k_setting', compact('details','nba2k'));
        }
        if($details->game_slug=='madden') {
            $madden = GameSetting::where('screen_id', $req->id)->pluck('game_setting_value', 'game_setting_key')->toArray();
            return view('admin.game.madden_setting', compact('details','madden'));
        }
        if($details->game_slug=='ufc3') {
            $ufc3 = GameSetting::where('screen_id', $req->id)->pluck('game_setting_value', 'game_setting_key')->toArray();
            return view('admin.game.ufc3_setting', compact('details','ufc3'));
        }
        if($details->game_slug=='fortnight') {
            $fortnight = GameSetting::where('screen_id', $req->id)->pluck('game_setting_value', 'game_setting_key')->toArray();
            return view('admin.game.fortnight_setting', compact('details','fortnight'));
        }
    }

    public function settingSave(Request $req)
    {
        if(empty($req->input()))
            return response()->json(false);
        $screenId = $req->input()['id'];
        GameSetting::where('screen_id', $screenId)->delete();
        foreach($req->input() as $key => $value) {
            if (!in_array($key, ['id', '_token'])) {
                $ins_ar = [
                    'screen_id' => $screenId,
                    'game_setting_key' => $key,
                    'game_setting_value' => $value,
                ];
                GameSetting::insert($ins_ar);
            }
        }
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/game/settings/' . $screenId);
    }

    public function rules(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = GameScreen::find($req->id);
        $rules = GameRule::where('screen_id', '=' , $details->id)->first();
        return view('admin.game.rules', compact('details', 'rules'));
    }

    public function rulessave(GameRuleRequest $req)
    {
        if(empty($req->input()))
            return response()->json(false);
        $model = GameRule::findOrNew($req->input('id'));
        $model->game_rule = $req->input('game_rule');
        $model->screen_id = $req->input('screen_id');
        $model->save();
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/game/rules/'.$req->input('screen_id'));
    }
}
