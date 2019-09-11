<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
//Model File
Use App\Models\GameScreen;

class HomeController extends Controller
{
    public function index()
    {
    	//echo "<pre>"; print_r(Auth::guard('web')->user()); echo "</pre>"; //die;
    	$data = GameScreen::all();
    	//echo "<pre>"; print_r($data ); echo "</pre>"; //die;
    	return View::make('admin.home', compact('data'));    	
    }
}
