<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GameScreen;
use App\Models\Game_Status;
use App\Models\GameRule;
use App\Models\CompetitionLevelType;
use App\Models\EventCategoryModel;
use App\Models\AdminEvent;
use App\Models\AdminVenue;

class ApiController extends Controller
{
    public function game_list(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;

        if($token)
        {
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
        }
        else
        {
            $status = 300;
            $statusCode = 402;
            $message = "Valid Token Is Missing";
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
		        					 $eventCnt += $each->eventcount->count();
	 
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
        $date = date('Y-m-d H:i:s');

        // dd($date);

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
	        			$event = AdminEvent::where('cat_id', $value->id)->where('event_status', '<>', 2)->get();
	        			if($event->count()>0)
	        			{
                            foreach ($event as $key => $value) 
                            {
                                
                                    $data['list'][] = $value;    
                            }
        					
                            
	        			}
                        else
                        {
                            $status = 300;
                            $statusCode = 402;
                            $message = "No Listing Found";
                        }
	        		}
	        	}
                // $Game_Status_Where = array('event_id' => );
                // $data['list']['contestents'] =

	        	$status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $data;
        	}
        	else
        	{
        		$status = 300;
	            $statusCode = 402;
	            $message = "Please Login First";
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
        $date = date('Y-m-d H:i:s');

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
                        $event_list = AdminEvent::where('cat_id', $value->id)->where('event_status', '<>', 2)->get();

                        

                        if($event_list->count()>0)
                        {
                            // $data['list'][] = $event_list;
                            foreach ($event_list as $key => $val) 
                            {
                                   $data['list'][] = $val; 
                                
                            }
                        }
                      
                            $event_serach = AdminEvent::where('cat_id', $value->id)->where('event_status', '<>', 2)
                                                        ->where(function($query) use($search){
                                                            $query->where('gen_title','LIKE','%'.$search.'%')
                                                                  ->orWhere('title','LIKE','%'.$search.'%');
                                                              })
                                                        ->get();


                             if($event_serach->count()>0)
                            {

                                foreach ($event_serach as $k => $v) 
                                {
                                    
                                        $data['search'][] = $v;                                     
                                }
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
                $message = "Please Login First";
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

    public function filter_fetch(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        
        if($token && $game_id)
        {
            $token_exist = User::where('login_token', $token)->first();

            if($token_exist)
            {
                $data['event_venue'] = AdminVenue::where('screen_id', $game_id)->get();

                $event = AdminEvent::where('event_type', $game_id)->get();


                $data['min'] = $event->min('entry_fees');
                $data['max'] = $event->max('entry_fees');
                $max_fees=$event->max('entry_fees');
                $interval_array=array();
                if ($max_fees!='' && $max_fees>0 && is_numeric($max_fees)) {
                    $interval=round($max_fees/10);
                    for($i=1;$i<=10;$i++){
                        $min=round(1+(($i-1)*$interval));
                        $max=round($i*$interval);
                        $fees_row=$min.'-'.$max;
                        array_push($interval_array,$fees_row);
                    }
                }
                $data['fees_interval'] = $interval_array;

                $status = 100;
                $statusCode = 200;
                $message = "Successful, Thank You For Joining ";
                $output = $data;
                
            }
            else
            {
                $status = 300;
                $statusCode = 402;
                $message = "Please Login First";
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

    public function filtered_event_list(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        $level_id = $request->comp_level_id;
        $category_id = $request->category_id;

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $venue = $request->venue;
        $entry_fees = $request->entry_fees;
        $payout = $request->payout;
        $game_entry_type = $request->game_entry_type;

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

                $data['list']=array();

                if(!empty($event_category))
                {
                    foreach ($event_category as $value) 
                    {
                        $event_query = AdminEvent::join('game_types', 'game_types.id', '=', 'game_event.game_type')
                        ->where('game_event.cat_id', $value->id);
                        if($start_date!=''){
                        $event_query->where('game_event.event_start_date', '>=',$start_date);
                        }
                        if($end_date!=''){
                        $event_query->where('game_event.event_start_date', '<=',$end_date);
                        }
                        if($venue!=''){
                        $event_query->where('game_event.venue', '=',$venue);
                        }
                        if($entry_fees!=''){
                        $entry_fees_array=explode("-",$entry_fees);
                        $event_query->whereBetween('game_event.entry_fees', [$entry_fees_array[0],$entry_fees_array[1]]);
                        }
                        if($payout!=''){
                        $payout_array=explode("-",$payout);
                        $event_query->whereBetween('game_event.win_prize', [$payout_array[0],$payout_array[1]]);
                        }

                        if($game_entry_type!=''){
                        $event_query->where('game_types.game_entry_type', '=',$game_entry_type);
                        }

                        $event=$event_query->get();
                        if($event->count()>0)
                        {
                            //$data['list'][] = $event;
                            $data['list'] = $event;
                        }
                        else
                        {
                            $status = 300;
                            $statusCode = 402;
                            $message = "No Listing Found";
                        }
                    }
                }
                // $Game_Status_Where = array('event_id' => );
                // $data['list']['contestents'] =

                $status = 100;
                $statusCode = 200;
                $message = "Successful, Data Found.";
                $output = $data;
            }
            else
            {
                $status = 300;
                $statusCode = 402;
                $message = "Please Login First";
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

    public function event_joining(Request $request)
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
            $token_exist = User::where('login_token', $token)->first();

            if($token_exist)
            {
                // $data['level'] = CompetitionLevelType::where('screen_id', $game_id)->get();
                 // $data['game'] = GameScreen::where('id', $game_id)->first();
                $event = AdminEvent::where('id', $event_id)->first();


                $event_count = count(Game_Status::where('status', 1)->where('event_id', $event_id)->get());

                $event_status = Game_Status::where('status', 1)->where('event_id', $event_id)->where('user_id', $token_exist->id)->first();
                // dd($event->max_members);
                if($event_status)
                {
                    $status = 300;
                    $statusCode = 402;
                    $message = "Already Joined";
                }
                else
                {
                    if($event->max_members > $event_count)
                    {
                        $game_status = new Game_Status;

                        $game_status->user_id      = $token_exist->id;
                        $game_status->event_id     = $event_id;
                        $game_status->category_id  = $category_id;
                        $game_status->level_id     = $level_id;
                        $game_status->game_id      = $game_id;
                        $game_status->status       = 1;


                        $game_status_insert = $game_status->save();

                        if($game_status_insert)
                        {
                            $status = 100;
                            $statusCode = 200;
                            $message = "Successful, Thank You For Joining ";
                            // $output = $data;
                        }
                        else
                        {
                            $status = 300;
                            $statusCode = 402;
                            $message = "Something Wrong";
                        }

                        
                    }
                    else
                    {
                        $status = 300;
                        $statusCode = 402;
                        $message = "Full";
                    }
                }
                

                
            }
            else
            {
                $status = 300;
                $statusCode = 402;
                $message = "Please Login First";
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


     public function event_statistic_list(Request $request)
    {
        $response = array();
        $output = array();
        $token = $request->token;
        $game_id = $request->screen_id;
        
        if($token)
        {
            $token_exist = User::where('login_token', $token)->get();

            if(count($token_exist)>0)
            {
                $game_screen = GameScreen::all();
                $data['games'] = $game_screen;
                if($game_screen)
                {
                        $live = AdminEvent::where('event_type', $game_id)->where('event_status', 1)->get();
                        $upcoming = AdminEvent::where('event_type', $game_id)->where('event_status', 0)->get();
                        $histroy = AdminEvent::where('event_type', $game_id)->where('event_status', 2)->get();

                        if($live)
                        {
                            foreach ($live as $val) 
                            {
                                $data['live'][] = $val;
                            }    
                        }
                        if($upcoming)
                        {
                            foreach ($upcoming as $val1) 
                            {
                                $data['upcoming'][] = $val1;
                            }
                        }
                        if($histroy)
                        {
                            foreach ($histroy as $val2) 
                            {
                                $data['histroy'][] = $val2;
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
            $message = "Valid Token Is Missing";
        }

        $response = array('status'=>$status, 'message'=>$message, 'result'=>$output);
        
        return response()->json($response);
    }

     

    
    
}
