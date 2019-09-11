<?php

namespace App\Http\Controllers\Cron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\AdminEvent;
class CronController extends Controller
{

    public function schedule_event(){

        $data = AdminEvent::all();       
        if($data->count()> 0)
        {
            foreach($data as $value ){
                date_default_timezone_set('Asia/Kolkata');
                $curdate_time = date('Y-m-d H:i:s');
                if($curdate_time >= $value->event_start_date && $curdate_time <=  $value->event_end_date){
                    //live
                    AdminEvent::where('id',$value->id)->update(array('event_status'=> 1));
                }
                else if($curdate_time >  $value->event_end_date){
                    AdminEvent::where('id',$value->id)->update(array('event_status'=> 2));
                }
            }
        }




    }
}
