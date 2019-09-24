<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Mail\ForgotPassword;
use App\Mail\EmailVerificationMail;
use App\Mail\CreateAccount;
use Datetime;


class AuthApiController extends Controller
{

    public function country()
    {
        $response = array();
        $output = array();

        $country = Country::all();

        if(count($country)>0)
        {
                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $country;
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "No Data Found !!!";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


     public function state($id)
    {
        $response = array();
        $output = array();


        $state = State::where('country_id', $id)->get();

        if(count($state)>0)
        {
                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $state;
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "No Data Found !!!";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function city($id)
    {
        $response = array();
        $output = array();


        $city = City::where('state_id', $id)->get();

        if(count($city)>0)
        {
                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $city;
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "No Data Found !!!";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function signup(Request $request)
    {
        $response = array();
        $output = array();
        
        // $json = file_get_contents('php://input');
        // $obj = json_decode($json, TRUE);
        
        $email = $request->input('email');
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $dob = new Datetime(date('Y-m-d', strtotime($request->input('dob'))));
        $check_age = $request->input('check_age');
        $terms_condition = $request->input('check_privacy');
        $today_date = new Datetime(date('Y-m-d'));
        $email_verification_code = mt_rand(1000,9999);

        $diff = $today_date->diff($dob);

        if($email && $password && $dob && $check_age == 1 && $terms_condition == 1) 
        {
            $email_exist = User::where('email', $email)->orWhere('username', $username)->get();

            if(count($email_exist)>0)
            {
                $status = 300;
                $statusCode = 404;
                $message = "Sorry, Username/Email already exist";
            }
            else
            {
                if($diff->y >= 18)
                {
                    //User Table Insert
                    $user = new User;

                    $user->email = $email;
                    $user->username = $username;
                    $user->user_type = 2;
                    $user->password = $request->input('password');
                    $user->status = 0;
                    $user->terms_conditions = $terms_condition;
                    $user->verification_code = $email_verification_code;
                    $user->is_verified = 0;

                    $user_insert = $user->save();


                    //User Info Table Insert
                    $new_user_details = User::where('email', $email)->first();
                    $userinfo = new UserInfo;
                    $userinfo->user_id = $new_user_details->id;
                    $userinfo->dob = $request->input('dob');
                    $userinfo->dob_verified = $check_age;

                    $userinfo_insert = $userinfo->save();

                    //============================Start Email Verification Mail===========================//
                    $emailVerify = [];
                    $emailVerify['name'] = $username;
                    $emailVerify['code'] = $email_verification_code;
                    Mail::to($email)->send(new EmailVerificationMail($emailVerify));
                    //=============================End Email Verification Mail===========================//

                    $status = 100;
                    $statusCode = 200;
                    $message = "Please Check Your Email For Email Verification"; 
                    $output = $new_user_details; 
                }
                else
                {
                    $status = 300;
                    $statusCode = 404;
                    $message = "Sorry, Your are not able to register because your age is below 18";   
                }
            }
            

        }
        else 
        {

            $status = 300;
            $statusCode = 404;
            $message = "Please fill all the required fields";
        }
        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function email_verification(Request $request)
    {
        $response = array();
        $output = array();

        $code = $request->input('code');

        if($code)
        {
            $code_exist = User::where('verification_code', $code)->first();

            if($code_exist != null)
            {
                $data = array(
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'is_verified' => 1,
                    'status' => 1
                );

                $user_update = User::where('id', $code_exist->id)->update($data);

                $status = 100;
                $statusCode = 200;
                $message = "Verification Done Succesfully"; 
                $output = $user_update; 

            }
            else
            {
                $status = 300;
                $statusCode = 404;
                $message = "Email verification code not valid";
            }
        }
        else
        {
            $status = 300;
            $statusCode = 404;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        return response()->json($response);
    }


    public function signup_second_step(Request $request)
    {
        $response = array();
        $output = array();
        
        // $json = file_get_contents('php://input');
        // $obj = json_decode($json, TRUE);

        $email_verify_code = $request->verify_code;

        $user_ver = User::where('verification_code', $email_verify_code)->first();

        $id = $user_ver->id;    
        $fname = $request->input('first_name');
        $lname = $request->input('last_name');
        $pno = $request->input('contact_no');
        $addr = $request->input('address');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $zipcode = $request->input('zip_code');

    
        if($fname && $lname && $pno && $addr && $pno && $country && $state && $city && $zipcode) 
        {
            $user_exist = User::where('id', $id)->get();

            if(count($user_exist)==0)
            {
                $status = 300;
                $statusCode = 404;
                $message = "Sorry, Account Not Found";
            }
            else
            {
                 $data = array('status'=>1);
                 $user_update = User::where('id', $id)->update($data);
                 $user_info_contact = UserInfo::where('contact_no', $pno)->get();
                 if(count($user_info_contact) != 0)
                 {
                    $status = 300;
                    $statusCode = 404;
                    $message = "Contact Number Is Already Exist";
                 }
                 else
                 {
                     $user_info_data = array(
                                     'first_name' => $fname,
                                     'last_name'  => $lname,
                                     'contact_no' => $pno,
                                     'address'    => $addr,
                                     'country'    => $country,
                                     'state'      => $state,
                                     'city'       => $city,
                                     'zipcode'    => $zipcode
                                     ); 
                       
                        $user_info_update = UserInfo::where('user_id', $id)->update($user_info_data); 

                        $userwhere = array('verification_code' => null);

                        $user_update = User::where('id', $id)->update($userwhere);

                        //============================Start Email Verification Mail===========================//
                            $user = [];
                            $user['name'] = $fname;
                            Mail::to($user_ver->email)->send(new CreateAccount($user));
                        //=============================End Email Verification Mail===========================//
                            
                        if($user_info_update)
                        {
                             $status = 100;
                             $statusCode = 200;
                             $message = "Resgistered Succesfully"; 
                             $output = $user_info_update;
                        }
                        else
                        {
                              $status = 300;
                              $statusCode = 404;
                              $message = "Sorry! Try Again, Your Registration Is Not Succesfully";
                        }
                 }               
            }
        }
        else 
        {
            $status = 300;
            $statusCode = 404;
            $message = "Please fill all the required fields";
        }
        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }
        
    public function signin(Request $request)
    {
        $response = array();
        $output = array();
        
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        if($email) 
        {
            $where = array('email'=> $email, 'user_type'=>2, 'status'=>1);
            $email_exist = User::where($where)->get();
            
            if(count($email_exist) > 0) 
            {
                  if(Hash::check($request->input('password'), $email_exist[0]->password))  
                  {
                    $token = array('login_token'=>md5(time().$email_exist[0]->password));
                    User::where('email', $email)->update($token);

                    $where = array('email'=> $email, 'user_type'=>2, 'status'=>1);
                    $login = User::where($where)->get();
                    $status = 100;
                    $statusCode = 200;
                    $message = "Successful, Login";
                    $output = $login;
                  }
                  else
                  {
                    $status = 300;
                    $statusCode = 401;
                    $message = "Sorry!, Please Check Your Password";
                  }
                
            } 
            else 
            {
                    $status = 300;
                    $statusCode = 401;
                    $message = "Sorry!, Username Not Exist";
            }
        } 
        else 
        {
            $status = 300;
            $statusCode = 404;
            $message = "Please fill all the required fields";
        }
        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }

    public function forget_password(Request $request)
    {
        $response = array();
        $output = array();
        $email = $request->input('email');
        
        if($email) {
            $new_password = mt_rand(100000,999999);
            $update_arr = [
                'password'   => Hash::make($new_password)
            ];
            $user = User::where('email', $email)->update($update_arr);
            if($user) 
            {

                /*************email********************/
                
                $forgot = [];
                $forgot['password'] = $new_password;
                
                Mail::to($email)->send(new ForgotPassword($forgot));
            
                /*************email********************/

                $status = 100;
                $statusCode = 200;
                $message = "Your new password is sent to the email provided, please find and login using that.";
                $output = $user;
            } 
            else 
            {
                $status = 300;
                $statusCode = 402;
                $message = "Unregistered email !!!";
            }
        } 
        else 
        {
            $status = 300;
            $statusCode = 404;
            $message = "Please fill all the required fields";
        }
        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    
    // public function mobile_otp_verification(Request $request)
    // {
    //     $response = array();
    //     $output = array();
    //     $json = file_get_contents('php://input');
    //     $obj = json_decode($json, TRUE);
    //     //print_r($obj);die();
    //     $otp = $obj['otp'];
    //     $authorization = explode('Bearer ', $request->header('Authorization'));
    //     $authorization = end($authorization);

    //     if($otp && $authorization) {
    //         $user_authorize = $this->userRepository->findByCondition(array('remember_token'=>$authorization));
    //         //print_r($authorization);die;
    //         if(count($user_authorize) > 0) {
    //             $user = $this->userRepository->findByCondition(array('mobile_verification_code'=>$otp,'remember_token'=>$authorization));
        
    //             if(count($user) > 0) {
    //                 $update_arr = [
    //                     'mobile_verification_code'   => 0,
    //                     'confirmed' => 1
    //                 ];
    //                 $user = $this->userRepository->updateByCondition(array('mobile_verification_code'=>$otp,'remember_token'=>$authorization), $update_arr);
    //                 if($user) {
    //                     $status = 100;
    //                     $statusCode = 200;
    //                     $message = "Successful";
    //                 } else {
    //                     $status = 300;
    //                     $statusCode = 402;
    //                     $message = "Sorry something wrong !!!";
    //                 }
    //             } else {
    //                 $status = 300;
    //                 $statusCode = 401;
    //                 $message = "OTP Verification code mismatch, click resend OTP";
    //             }
    //         } else {
    //             $status = 300;
    //             $statusCode = 401;
    //             $message = "Unauthenticated user";
    //         }
            
    //     } else {
    //         $status = 300;
    //         $statusCode = 404;
    //         $message = "Please fill all the required fields";
    //     }
    //     $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
    //     return response()->json($response);
    // }


     
    


}
