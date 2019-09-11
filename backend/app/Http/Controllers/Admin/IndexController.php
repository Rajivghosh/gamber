<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use Hash;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
    	return View::make('admin.index');
    }

    public function login(LoginRequest $req)
    {
    	if(empty($req->input()))
    		return response()->json(false);
    	$data = User::where('email', $req->input('username'))->first();
    	if(empty($data)) {
    		$req->session()->flash('error', 'Invalid Admin');
    		return redirect('/admin');
    	}
    	if(Hash::check($req->input('password'), $data->password)) {
    		Auth::guard('web')->login($data);
        	$req->session()->flash('success', 'Login Successful');
        	return redirect('/admin/home');
    	}
    }
    
    public function logout() {       
        Auth::logout();
        return redirect('/admin');
    }
}
