<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GameScreen;
use App\Models\GameRule;
use App\Models\CompetitionLevelType;
use App\Models\EventCategoryModel;
use App\Models\AdminEvent;

class ApiController extends Controller
{
    public function game_list(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;

        $token_exist = User::where('login_token', $token)->get();

        if(count($token_exist)>0)
        {
        	$game_screen = GameScreen::all();
        	if($game_screen)
        	{
        		$status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $game_screen;
        	}
        	else
        	{
        		$status = 300;
	            $statusCode = 402;
	            $message = "No Data Found !!!";	
        	}
                
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "Login Credential Not Matched";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function game_comp_level(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;

        if($token && $game_id)
        {
        	$token_exist = User::where('login_token', $token)->get();

        	if(count($token_exist)>0)
	        {
	        	// $competition_level[] = '';
	        	$competition_level['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
	        	$competition_level['game'] = GameScreen::where('id', $game_id)->get();
	        	foreach ($competition_level['level'] as $key => $value) {
	        		
	        		$competition_level['level'][$key]['type'] = ($value->name == 'Compitative') ? 'Paid Event' : 'Free Event';	
	        	}

	        	if(count($competition_level) != 0)
	        	{
	        		$status = 100;
	                $statusCode = 200;
	                $message = "Successful, Data Found.";
	                $output = $competition_level;
	        	}
	        	else
	        	{
	        		$status = 300;
		            $statusCode = 402;
		            $message = "No Data Found !!!";	
	        	}
	                
	        }
	        else
	        {
	            $status = 300;
	            $statusCode = 402;
	            $message = "Login Credential Not Matched";
	        }
        }
        else
        {
        	$status = 300;
            $statusCode = 402;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function event_category(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        $level_id = $request->comp_level_id;

        if($token && $game_id && $level_id)
        {
        	$token_exist = User::where('login_token', $token)->get();

        	if(count($token_exist)>0)
	        {
	        	$data['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
	        	$data['game'] = GameScreen::where('id', $game_id)->get();
	        	foreach ($data['level'] as $key => $value) 
	        	{
	        		$data['level'][$key]['type'] = ($value->name == 'Compitative') ? 'Paid Event' : 'Free Event';	
	        	}

	        	if(count($data) != 0)
	        	{
	        		$data['category'] = EventCategoryModel::where('level_id', $level_id)->where('screen_id', $game_id)->where('category_parent_id', 0)->get();
	        		if(count($data['category']) > 0)
	        		{
	        			foreach ($data['category'] as $key => $value) 
	        			{
	        				$eventCnt = 0;
	        				$sub_category = EventCategoryModel::where('category_parent_id', $value->id)->get();
	        				if(!empty($sub_category))
	        				{
		        				foreach ($sub_category as $k => $each) 
		        				{
		        					 $eventCnt += $each->event->count();
	 
		        				}
		        				$data['category'][$key]['count'] = $eventCnt;
		        				
	        				}
	        			}

		        		$status = 100;
		                $statusCode = 200;
		                $message = "Successful, Data Found.";
		                $output = $data;
		            }
		            else
		            {
		            	$status = 300;
			            $statusCode = 402;
			            $message = "No Data Found!!!";
		            }
	        	}
	        	else
	        	{
	        		$status = 300;
		            $statusCode = 402;
		            $message = "No Compitition Level Data Found !!!";	
	        	}
	                
	        }
	        else
	        {
	            $status = 300;
	            $statusCode = 402;
	            $message = "Login Credential Not Matched";
	        }
        }
        else
        {
        	$status = 300;
            $statusCode = 402;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function event_list(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        $level_id = $request->comp_level_id;
        $category_id = $request->category_id;

        if($token && $game_id && $level_id && $category_id)
        {
        	$token_exist = User::where('login_token', $token)->get();

        	if(count($token_exist)>0)
        	{
        		$data['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
	        	$data['game'] = GameScreen::where('id', $game_id)->get();
	        	foreach ($data['level'] as $key => $value) 
	        	{
	        		$data['level'][$key]['type'] = ($value->name == 'Compitative') ? 'Paid Event' : 'Free Event';	
	        	}

	        	$event_category = EventCategoryModel::where('category_parent_id', $category_id)->get();

	        	if(!empty($event_category))
	        	{
	        		foreach ($event_category as $value) 
	        		{
	        			$event = AdminEvent::where('cat_id', $value->id)->get();
	        			if($event->count()>0)
	        			{
        					$data['list'][] = $event;
	        			}
	        		}
	        	}

	        	$status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $data;
        	}
        	else
        	{
        		$status = 300;
	            $statusCode = 402;
	            $message = "Please fill all the required fields";
        	}
        }
        else
        {
        	$status = 300;
            $statusCode = 402;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function event_search(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        $level_id = $request->comp_level_id;
        $category_id = $request->category_id;
        $search = $request->search;

        if($token && $game_id && $level_id && $category_id)
        {
            $token_exist = User::where('login_token', $token)->get();

            if(count($token_exist)>0)
            {
                $data['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
                $data['game'] = GameScreen::where('id', $game_id)->get();
                foreach ($data['level'] as $key => $value) 
                {
                    $data['level'][$key]['type'] = ($value->name == 'Compitative') ? 'Paid Event' : 'Free Event';   
                }

                $event_category = EventCategoryModel::where('category_parent_id', $category_id)->get();

                if(!empty($event_category))
                {
                    foreach ($event_category as $value) 
                    {
                        $event_list = AdminEvent::where('cat_id', $value->id)->get();

                        

                        if($event_list->count()>0)
                        {
                            $data['list'][] = $event_list;
                        }
                      
                            $event_serach = AdminEvent::where('cat_id', $value->id)
                                                        ->where(function($query) use($search){
                                                            $query->where('gen_title','LIKE','%'.$search.'%')
                                                                  ->orWhere('title','LIKE','%'.$search.'%');
                                                              })
                                                        ->get();


                             if($event_serach->count()>0)
                            {
                                $data['search'][] = $event_serach;
                            }
                            // else
                            // {
                            //     $status = 300;
                            //     $statusCode = 402;
                            //     $message = "No search result found";

                            // }
                      } 

                      $data['search'][] = $event_serach;

                }

                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $data;
            }
            else
            {
                $status = 300;
                $statusCode = 402;
                $message = "Please fill all the required fields";
            }
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }


    public function event_details(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        $level_id = $request->comp_level_id;
        $category_id = $request->category_id;
        $event_id = $request->event_id;

        if($token && $game_id && $level_id && $category_id)
        {
            $token_exist = User::where('login_token', $token)->get();

            if(count($token_exist)>0)
            {
                // $data['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
                 $data['game'] = GameScreen::where('id', $game_id)->first();
                 
                // foreach ($data['level'] as $key => $value) 
                // {
                //     $data['level'][$key]['type'] = ($value->name == 'Compitative') ? 'Paid Event' : 'Free Event';   
                // }

                $event_category = EventCategoryModel::where('category_parent_id', $category_id)->get();

                if(!empty($event_category))
                { 

                    $event_details =  AdminEvent::find($event_id);

                    $data['details'] = $event_details;
                    $data['details']['venue'] = $event_details->game_venue->name;
                    $data['details']['game_type'] = $event_details->type->name;
                    $data['details']['event_type'] = $event_details->screen->game_screen_name;
                    $data['details']['cat_id'] = $event_details->category->parent->name;
                    $data['details']['subcat'] = $event_details->category->name;

                }
                $data['rules'] = GameRule::where('screen_id', $game_id)->first();

                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $data;
            }
            else
            {
                $status = 300;
                $statusCode = 402;
                $message = "Please fill all the required fields";
            }
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "Please fill all the required fields";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }

    
    
}