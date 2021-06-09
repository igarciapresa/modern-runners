<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Activity::where('strava_user_id', '=', $user->id_strava)->delete();
        EventActivity::where('strava_user_id', '=', $user->id_strava)->delete();
    }

    public function getTeammates(Request $request)
    {
        $token = $request->session()->get('access_token');
        $users = User::where('access_token', '!=', $token)->get();
        return $users;
    }

    public function getUserActivities(Request $request, $page)
    {
        $token = $request->session()->get('access_token');
        $user = User::where('access_token', '=', $token)->first();
        $activities = Activity::where('strava_user_id', '>=', $user->id_strava)->paginate(8, ['*'], 'page', $page);
        return $activities;
    }

    public function getAuthUser(Request $request)
    {
        $token = $request->session()->get('access_token');
        $user = User::where('access_token', '=', $token)->first();
        return $user;
    }

    public function ranking()
    {
        $users = User::orderBy('points', 'desc')->get();
        return $users;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->why_run = $request->why_run;
        $user->save();

        $user_activities = Activity::where('strava_user_id', '=', $user->id_strava)->get();
        for($i = 0; $i < count($user_activities); $i++)
        {
            $user_activities[$i]->user_name = $user->first_name . ' ' . $user->last_name;
            $user_activities[$i]->save();
        }
        return $user;
    }
}
