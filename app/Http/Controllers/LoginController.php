<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Event;
use App\Models\EventActivity;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Strava;

class LoginController extends Controller
{

    public function stravaAuth(Request $request)
    {
        if ($request->session()->has('access_token'))
        { //If there is an authentified user, send him to the dashboard
            $value = $request->session()->get('access_token');
            return redirect('/dashboard');
        }
        else{
            return Strava::authenticate($scope='profile:read_all,activity:read_all');
        }
    }

    public function checkFinishedEvents()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $events = Event::where('finished', '=', false)->where('end_date', '<', $date)->get();
        for($i = 0; $i < count($events); $i++)
        {
            $event_activities = EventActivity::where('event_id', '=', $events[$i]->id)->get();
            $activities = [];
            for($a = 0; $a < count($event_activities); $a++)
            {
                $activity = Activity::where('strava_activity_id', '=', $event_activities[$a]->strava_activity_id)->first();
                array_push($activities, $activity);
            }
            $activities = collect($activities);
            $sorted = $activities->sortBy('moving_time')->values();
            $activities = $sorted->toArray();

            $user0 = User::where('id_strava', '=', $activities[0]['strava_user_id'])->first();
            $user0->points += 1000;
            $user0->gold_medals += 1;
            $user0->save();

            $user1 = User::where('id_strava', '=', $activities[1]['strava_user_id'])->first();
            $user1->points += 300;
            $user1->silver_medals += 1;
            $user1->save();

            $user2 = User::where('id_strava', '=', $activities[2]['strava_user_id'])->first();
            $user2->points += 100;
            $user2->bronze_medals += 1;
            $user2->save();

            $events[$i]->finished = true;
            $events[$i]->save();
        }
    }

    public function getToken(Request $request)
    {
        try{
            $this->checkFinishedEvents();
            $token = Strava::token($request->code);
            $tokenuser = $token->athlete;
            $user = User::where('id_strava', '=', $tokenuser->id)->first();
            
            if ($user === null)
            { //Register user in DB if it doesn´t exist
                $user = new User;
                $user->id_strava = $tokenuser->id;
                $user->first_name = $tokenuser->firstname;
                $user->last_name = $tokenuser->lastname;
                $user->access_token = $token->access_token;
                $user->refresh_token = $token->refresh_token;
                $user->save();
            }
            else
            {
                $user->access_token = $token->access_token;
                $user->refresh_token = $token->refresh_token;
                $user->update();
            }
            //Create session for the user
            session(['access_token' => $token->access_token]);
            if ($request->session()->has('access_token'))
            { //If there is an authentified user, send him to the dashboard
                $value = $request->session()->get('access_token');
                return redirect('/dashboard');
            }
            else
            { //If the authetification fails, send back to landing page
                return view('welcome');
            }
        }
        catch (Exception $e){
            Log::critical(__METHOD__ . ' '. __LINE__. ' mensaje: error en parámetros');
        }
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
