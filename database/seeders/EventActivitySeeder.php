<?php

namespace Database\Seeders;

use App\Models\EventActivity;
use Illuminate\Database\Seeder;

class EventActivitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $event_activity = new EventActivity();
        $event_activity->strava_activity_id = 1;
        $event_activity->strava_user_id = 1;
        $event_activity->event_id = 1;
        $event_activity->save();

        $event_activity2 = new EventActivity();
        $event_activity2->strava_activity_id = 2;
        $event_activity2->strava_user_id = 1;
        $event_activity2->event_id = 3;
        $event_activity2->save();

        $event_activity3 = new EventActivity();
        $event_activity3->strava_activity_id = 4;
        $event_activity3->strava_user_id = 2;
        $event_activity3->event_id = 1;
        $event_activity3->save();

        $event_activity4 = new EventActivity();
        $event_activity4->strava_activity_id = 6;
        $event_activity4->strava_user_id = 2;
        $event_activity4->event_id = 3;
        $event_activity4->save();

        $event_activity5 = new EventActivity();
        $event_activity5->strava_activity_id = 7;
        $event_activity5->strava_user_id = 3;
        $event_activity5->event_id = 1;
        $event_activity5->save();

        $event_activity6 = new EventActivity();
        $event_activity6->strava_activity_id = 8;
        $event_activity6->strava_user_id = 3;
        $event_activity6->event_id = 3;
        $event_activity6->save();

        $event_activity7 = new EventActivity();
        $event_activity7->strava_activity_id = 10;
        $event_activity7->strava_user_id = 4;
        $event_activity7->event_id = 1;
        $event_activity7->save();

        $event_activity8 = new EventActivity();
        $event_activity8->strava_activity_id = 12;
        $event_activity8->strava_user_id = 5;
        $event_activity8->event_id = 1;
        $event_activity8->save();

        $event_activity9 = new EventActivity();
        $event_activity9->strava_activity_id = 12;
        $event_activity9->strava_user_id = 5;
        $event_activity9->event_id = 3;
        $event_activity9->save();

        $event_activity10 = new EventActivity();
        $event_activity10->strava_activity_id = 1;
        $event_activity10->strava_user_id = 1;
        $event_activity10->event_id = 2;
        $event_activity10->save();

        $event_activity11 = new EventActivity();
        $event_activity11->strava_activity_id = 4;
        $event_activity11->strava_user_id = 2;
        $event_activity11->event_id = 2;
        $event_activity11->save();

        $event_activity12 = new EventActivity();
        $event_activity12->strava_activity_id = 7;
        $event_activity12->strava_user_id = 3;
        $event_activity12->event_id = 2;
        $event_activity12->save();

        $event_activity13 = new EventActivity();
        $event_activity13->strava_activity_id = 9;
        $event_activity13->strava_user_id = 4;
        $event_activity13->event_id = 2;
        $event_activity13->save();

        $event_activity14 = new EventActivity();
        $event_activity14->strava_activity_id = 11;
        $event_activity14->strava_user_id = 5;
        $event_activity14->event_id = 2;
        $event_activity14->save();
    }
}