<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
use App\Http\Requests\Admin\AdminUserRequest;
//Loading model file
Use App\Models\User;
Use App\Models\Country;
Use App\Models\State;
Use App\Models\City;
Use App\Models\UserInfo;
use Datetime;

class AdminUserController extends Controller
{
    public function index()
    {        
        $data = User::where('user_type', 2)->get(); 
        
        return view('admin.users.list', compact('data'));
    }

    public function add()
    {
        $country = Country::all();
        return View::make('admin.users.form', compact('country'));
    }

    public function liststateById(Request $req)
    {
        $statedata = State::where('country_id', $req->country_id)->get();
        return view('admin.users.ajax_fetch_state', compact('statedata'));     
    }

    public function listcityById(Request $req)
    {
        $citydata = City::where('state_id', $req->id)->get();   
        return view('admin.users.ajax_fetch_city', compact('citydata'));     
    }

    public function save(AdminUserRequest $req)
    {
        // dd($req->input());
        $today_date = new Datetime(date('Y-m-d'));
        $dob = new Datetime(date('Y-m-d', strtotime($req->input('dob'))));
        $diff = $today_date->diff($dob);

        if(empty($req->input()))
            return response()->json(false);
        if($diff->y >= 18)
        {
            $model = User::findOrNew($req->input('id'));
            $existing = $model->exists;
            $model->username = $req->input('username');
            $model->user_type = 2;
            $model->email = $req->input('email');
            $model->password = $req->input('password');
            if ($model->save()) {
                //Save data into user info table
                if ($existing == 1) {
                    $info = UserInfo::find($model->info->id);
                } else {
                    $info = new UserInfo;
                }
                $info->user_id = $model->id;
                $info->first_name = $req->input('first_name');
                $info->last_name = $req->input('last_name');
                $info->address = $req->input('address');
                $info->city = $req->input('city');
                $info->state = $req->input('state');
                $info->zipcode = $req->input('zipcode');
                $info->country = $req->input('country');
                $info->dob  = $req->input('dob');
                $info->contact_no  = $req->input('contact_no');    
                if ($info->save()) {
                    $req->session()->flash('success', 'Admin profile created successfully.');
                    return redirect('/admin/users/list');
                }
            }
        }
        else
        {
            $req->session()->flash('errors', 'User Is Not Eligible For Registration');
            return redirect('/admin/users/list');
        }
    }

    public function remove(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $allow = 1;
        //Write dependency code implement here

        //----------------------------------//
        if ($allow == 1) {            
            User::where('id', $req->id)->delete();
        }
        $req->session()->flash('success', 'Task was successful');
        return redirect('/admin/users/list');
    }

    public function details(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = User::find($req->id);
       
        return view('admin.users.users_details', compact('details'));
    }
    
    public function edit(Request $req)
    {
        if (empty($req->id))
            return response()->json(false);
        $details = User::find($req->id);
        $country = Country::all();     
        return view('admin.users.form', compact('details', 'country'));
    }


    public function status(Request $req)
    {
        $id = $req->input('userid');

        $user = User::find($id);

        // echo "<pre>";
        // print_r($user);
        // exit;

        if($user->status == 1)
        {
            $data = array('status'=>0);
            $update = User::where('id', '=', $id)->update($data);
        }
        else
        {
            $data = array('status'=>1);
            $update = User::where('id', '=', $id)->update($data);

        }

        

        if($update)
        {
            echo 1;
        }
    }
}