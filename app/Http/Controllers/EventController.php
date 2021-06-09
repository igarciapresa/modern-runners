<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Event;
use App\Models\EventActivity;

class EventController extends Controller
{
    public function addEvent(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->goal = $request->goal;
        $event->end_date = $request->new_end_date;
        $event->start_date = $request->new_start_date;
        $event->description = $request->description;
        $event->save();

        $activities = Activity::get();

        $current_date = date('Y-m-d', Carbon::now()->timestamp);
        if($event->end_date >= $current_date && $event->start_date <= $current_date)
        {// Is the event active?
            for($a = 0; $a < count($activities); $a++)
            {
                if($activities[$a]->distance >= $event->goal*1000 && $activities[$a]->date >= $event->start_date && $activities[$a]->date <= $event->end_date)
                {// Is activity long enough for the event?
    
                    $prev_event_activity = EventActivity::where('strava_user_id', '=', $activities[$a]->strava_user_id)->where('event_id', '=', $event->id)->first();
                    
                    if(!$prev_event_activity)
                    {// Doesn't the user already have an activity recorded for this event?
                        $eventActivity = new EventActivity;
                        $eventActivity->strava_activity_id = $activities[$a]->strava_activity_id;
                        $eventActivity->strava_user_id = $activities[$a]->strava_user_id;
                        $eventActivity->event_id = $event->id;
                        $eventActivity->save();
                    }
    
                    else
                    {
    
                        $prev_activity = Activity::where('strava_activity_id', '=', $prev_event_activity->strava_activity_id)->first();
                        
                        if($activities[$a]->moving_time < $prev_activity->moving_time)
                        {// Is the activity faster than the previous one recorded for the user in this event?
                            $prev_event_activity->delete();
                            $eventActivity = new EventActivity;
                            $eventActivity->strava_activity_id = $activities[$a]->strava_activity_id;
                            $eventActivity->strava_user_id = $activities[$a]->strava_user_id;
                            $eventActivity->event_id = $event->id;
                            $eventActivity->save();
                        }
                    }
                }
            }
        }

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        EventActivity::where('event_id', '=', $id)->delete();
    }

    public function get($id)
    {
        return Event::find($id);
    }

    public function getCurrentEvent()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $event = Event::where('end_date', '>', $date)->orderBy('end_date', 'asc')->first();
        return $event->end_date;
    }

    public function getActiveEvents()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $events = Event::where('end_date', '>', $date)->orderBy('end_date', 'asc')->get();
        return $events;
    }

    public function getLatestEvents()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $events = Event::where('end_date', '<=', $date)->orderBy('end_date', 'asc')->get();
        return $events;
    }

    public function getActivities($id)
    {
        $event_activities = EventActivity::where('event_id', '=', $id);
        $activities = [];
        for($i = 0; $i < count($event_activities); $i++)
        {
            $activity = Activity::where('strava_activity_id', '=', $event_activities[$i]->strava_activity_id);
            $activities.push($activity);
        }
        return $activities;
    }

    public function getActiveEventsActivities()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $events = Event::where('end_date', '>=', $date)->orderBy('end_date', 'asc')->get();
        $active_events_activities = [];
        for($i = 0; $i<count($events); $i++)
        {
            $event_activities = EventActivity::where('event_id', '=', $events[$i]->id)->get();
            $activity_ids = [];
            for($a = 0; $a < count($event_activities); $a++)
            {
                array_push($activity_ids, $event_activities[$a]->strava_activity_id);
            }
            $activities = Activity::whereIn('strava_activity_id', $activity_ids)->orderBy('moving_time', 'asc')->get();
            $active_events_activities[$i] = $activities;
        }
        return $active_events_activities;
    }

    public function getLatestEventsActivities()
    {
        $date = date('Y-m-d', Carbon::now()->timestamp);
        $events = Event::where('end_date', '<', $date)->orderBy('end_date', 'asc')->get();
        $latest_events_activities = [];
        for($i = 0; $i<count($events); $i++)
        {
            $event_activities = EventActivity::where('event_id', '=', $events[$i]->id)->get();
            $activity_ids = [];
            for($a = 0; $a < count($event_activities); $a++)
            {
                array_push($activity_ids, $event_activities[$a]->strava_activity_id);
            }
            $activities = Activity::whereIn('strava_activity_id', $activity_ids)->orderBy('moving_time', 'asc')->get();
            $latest_events_activities[$i] = $activities;
        }
        return $latest_events_activities;
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->name = $request->name;
        $event->goal = $request->goal;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->save();

        EventActivity::where('event_id', $id)->delete();

        $activities = Activity::get();

        $current_date = date('Y-m-d', Carbon::now()->timestamp);
        if($event->end_date >= $current_date && $event->start_date <= $current_date)
        {// Is the event active?
            for($a = 0; $a < count($activities); $a++)
            {
                if($activities[$a]->distance >= $event->goal*1000 && $activities[$a]->date >= $event->start_date && $activities[$a]->date <= $event->end_date)
                {// Is activity long enough for the event?
    
                    $prev_event_activity = EventActivity::where('strava_user_id', '=', $activities[$a]->strava_user_id)->where('event_id', '=', $event->id)->first();
                    
                    if(!$prev_event_activity)
                    {// Doesn't the user already have an activity recorded for this event?
                        $eventActivity = new EventActivity;
                        $eventActivity->strava_activity_id = $activities[$a]->strava_activity_id;
                        $eventActivity->strava_user_id = $activities[$a]->strava_user_id;
                        $eventActivity->event_id = $event->id;
                        $eventActivity->save();
                    }
    
                    else
                    {
    
                        $prev_activity = Activity::where('strava_activity_id', '=', $prev_event_activity->strava_activity_id)->first();
                        
                        if($activities[$a]->moving_time < $prev_activity->moving_time)
                        {// Is the activity faster than the previous one recorded for the user in this event?
                            $prev_event_activity->delete();
                            $eventActivity = new EventActivity;
                            $eventActivity->strava_activity_id = $activities[$a]->strava_activity_id;
                            $eventActivity->strava_user_id = $activities[$a]->strava_user_id;
                            $eventActivity->event_id = $event->id;
                            $eventActivity->save();
                        }
                    }
                }
            }
        }
        return $event;
    }
}
