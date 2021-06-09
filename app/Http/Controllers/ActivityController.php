<?php


namespace App\Http\Controllers;

use App\Classes\Tools;
use App\Classes\StravaWrapper;
use App\Http\Controllers\EventController;
use App\Models\Activity;
use App\Models\Event;
use App\Models\EventActivity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController
{

    public function getUserActivities(Request $request){

        if ($request->session()->has('access_token')) {
            $user = User::where('access_token', '=', session()->get('access_token'))->first();
            $strava = new StravaWrapper();
            $result = $strava->curlActivities($request);

            if (count($result) > 0){
                for($i = 0; $i < count($result); $i++)
                {
                    $events = Event::get();
                    $activity = Activity::where('strava_activity_id', '=', $result[$i]->id)->first();
                    if($activity === null && $result[$i]->type === 'Run')
                    {
                        $activity = new Activity;
                        $activity->strava_activity_id = $result[$i]->id;
                        $activity->strava_user_id = $result[$i]->athlete->id;
                        $activity->name = $result[$i]->name;
                        $activity->date = Tools::dateToStrtime($result[$i]->start_date);
                        $activity->distance = $result[$i]->distance;
                        $activity->moving_time = $result[$i]->moving_time;
                        $activity->user_name = $user->first_name . ' ' . $user->last_name;
                        $activity->save();

                        $current_date = date('Y-m-d', Carbon::now()->timestamp);
                        for($a = 0; $a < count($events); $a++)
                        {
                            if($events[$a]->end_date >= $current_date && $activity->distance >= $events[$a]->goal*1000 && $activity->date >= $events[$a]->start_date && $activity->date <= $events[$a]->end_date)
                            {// Is event active and activity suitable for the event?

                                $prev_event_activity = EventActivity::where('strava_user_id', '=', $activity->strava_user_id)->where('event_id', '=', $events[$a]->id)->first();
                                
                                if(!$prev_event_activity)
                                {// Doesn't the user already have an activity recorded for this event?
                                    $eventActivity = new EventActivity;
                                    $eventActivity->strava_activity_id = $activity->strava_activity_id;
                                    $eventActivity->strava_user_id = $activity->strava_user_id;
                                    $eventActivity->event_id = $events[$a]->id;
                                    $eventActivity->save();
                                }

                                else
                                {

                                    $prev_activity = Activity::where('strava_activity_id', '=', $prev_event_activity->strava_activity_id)->first();
                                    
                                    if($activity->moving_time < $prev_activity->moving_time)
                                    {// Is the activity faster than the previous one recorded for the user in this event?
                                        $prev_event_activity->delete();
                                        $eventActivity = new EventActivity;
                                        $eventActivity->strava_activity_id = $activity->strava_activity_id;
                                        $eventActivity->strava_user_id = $activity->strava_user_id;
                                        $eventActivity->event_id = $events[$a]->id;
                                        $eventActivity->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $user_token = $request->session()->get('access_token');
            $user = User::where('access_token', '=', $user_token)->first();
            
            return view('home');
        }
        else{
            return redirect('/');
        }

    }

    /* public function getActivity(Request $request){

        $id = 5279362471;
        if ($request->session()->has('access_token')) {
            $token = $request->session()->get('access_token');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.strava.com/api/v3/activities/'.$id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result= json_decode($response);

            dd($result);
        }
        else{
            dd('no hay sesion');
        }

    } */

}
