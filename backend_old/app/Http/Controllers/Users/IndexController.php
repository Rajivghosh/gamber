<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use App\Http\Requests\Users\RegisterRequest;
//Loading model file
use App\Models\User;
use App\Models\UserInfo;

class IndexController extends Controller
{
   public function index()
   {    	
      return View::make('user.register');
   }
   public function register(RegisterRequest $req)
   {       

      if(empty($req->input()))
         return response()->json(false);
      if(User::where('email', $req->input('email'))) {
         $model = new User;
         $existing = $model->exists;
         $model->username = $req->input('first_name');
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
            $info->dob = date('Y-m-d',strtotime($req->input('dob')));
            
            $info->contact_no = $req->input('contact_no');         

            if ($info->save()) {
               $req->session()->flash('success', 'Register successfully.');
               return redirect('/user/register');
               
            }
         }
      }
   }
   public function echeckExistEmail(Request $req){
      $data = User::where('email', '=',$req->email)->get();
      $exist = 0;
      if($data->count()>0){
         $exist = 1;
      }
      return response()->json(['exist' => $exist]);
   }
}
