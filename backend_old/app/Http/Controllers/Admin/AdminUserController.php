<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use View;
use App\Http\Requests\Admin\AdminUserRequest;
//Loading model file
Use App\Models\User;
Use App\Models\UserInfo;

class AdminUserController extends Controller
{
    public function index()
    {        
        $data = User::where('user_type', 2)->get(); 
        return view('admin.users.list', compact('data'));
    }

    public function add()
    {
        return View::make('admin.users.form');
    }

    public function save(AdminUserRequest $req)
    {
        if(empty($req->input()))
            return response()->json(false);
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
        return view('admin.users.form', compact('details'));
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