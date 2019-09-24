<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use App\Http\Requests\Admin\RegisterRequest;
//Loading model file
use App\Models\User;
use App\Models\UserInfo;

class RegisterController extends Controller
{
	public function index()
   	{
   		return View::make('admin.register');
   	}

   	public function register(RegisterRequest $req)
   	{
   		if(empty($req->input()))
   			return response()->json(false);
   		$model = User::findOrNew($req->input('id'));
		   $existing = $model->exists;
   		$model->username = $req->input('first_name');
   		$model->user_type = 1;
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
   			if ($info->save()) {
	   			$req->session()->flash('success', 'Admin profile created successfully.');
	   			return redirect('/admin');
   			}
   		}
   	}
}
