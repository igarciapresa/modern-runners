<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $activity = new Activity();
        $activity->strava_activity_id = 1;
        $activity->strava_user_id = 1;
        $activity->name = "Evening run";
        $activity->date = "2021-05-09";
        $activity->distance = 5200;
        $activity->moving_time = 1800;
        $activity->user_name = "Peter Jones";
        $activity->save();

        $activity2 = new Activity();
        $activity2->strava_activity_id = 2;
        $activity2->strava_user_id = 1;
        $activity2->name = "Evening run";
        $activity2->date = "2021-05-05";
        $activity2->distance = 7100;
        $activity2->moving_time = 2000;
        $activity2->user_name = "Peter Jones";
        $activity2->save();

        $activity3 = new Activity();
        $activity3->strava_activity_id = 3;
        $activity3->strava_user_id = 1;
        $activity3->name = "Evening run";
        $activity3->date = "2021-06-03";
        $activity3->distance = 8000;
        $activity3->moving_time = 2500;
        $activity3->user_name = "Peter Jones";
        $activity3->save();

        $activity4 = new Activity();
        $activity4->strava_activity_id = 4;
        $activity4->strava_user_id = 2;
        $activity4->name = "Evening run";
        $activity4->date = "2021-05-05";
        $activity4->distance = 5150;
        $activity4->moving_time = 1700;
        $activity4->user_name = "Jamie Petterson";
        $activity4->save();

        $activity5 = new Activity();
        $activity5->strava_activity_id = 5;
        $activity5->strava_user_id = 2;
        $activity5->name = "Evening run";
        $activity5->date = "2021-05-30";
        $activity5->distance = 6230;
        $activity5->moving_time = 1850;
        $activity5->user_name = "Jamie Petterson";
        $activity5->save();

        $activity6 = new Activity();
        $activity6->strava_activity_id = 6;
        $activity6->strava_user_id = 2;
        $activity6->name = "Evening run";
        $activity6->date = "2021-05-27";
        $activity6->distance = 7500;
        $activity6->moving_time = 2050;
        $activity6->user_name = "Jamie Petterson";
        $activity6->save();

        $activity7 = new Activity();
        $activity7->strava_activity_id = 7;
        $activity7->strava_user_id = 3;
        $activity7->name = "Evening run";
        $activity7->date = "2021-05-02";
        $activity7->distance = 5500;
        $activity7->moving_time = 1600;
        $activity7->user_name = "Rachel Washington";
        $activity7->save();

        $activity8 = new Activity();
        $activity8->strava_activity_id = 8;
        $activity8->strava_user_id = 3;
        $activity8->name = "Evening run";
        $activity8->date = "2021-05-05";
        $activity8->distance = 7240;
        $activity8->moving_time = 2200;
        $activity8->user_name = "Rachel Washington";
        $activity8->save();

        $activity9 = new Activity();
        $activity9->strava_activity_id = 9;
        $activity9->strava_user_id = 4;
        $activity9->name = "Evening run";
        $activity9->date = "2021-05-05";
        $activity9->distance = 3240;
        $activity9->moving_time = 1200;
        $activity9->user_name = "Michael Francis";
        $activity9->save();

        $activity10 = new Activity();
        $activity10->strava_activity_id = 10;
        $activity10->strava_user_id = 4;
        $activity10->name = "Evening run";
        $activity10->date = "2021-05-05";
        $activity10->distance = 6240;
        $activity10->moving_time = 2100;
        $activity10->user_name = "Michael Francis";
        $activity10->save();

        $activity11 = new Activity();
        $activity11->strava_activity_id = 11;
        $activity11->strava_user_id = 5;
        $activity11->name = "Evening run";
        $activity11->date = "2021-05-05";
        $activity11->distance = 3500;
        $activity11->moving_time = 1300;
        $activity11->user_name = "Anna Wilson";
        $activity11->save();

        $activity12 = new Activity();
        $activity12->strava_activity_id = 12;
        $activity12->strava_user_id = 5;
        $activity12->name = "Evening run";
        $activity12->date = "2021-05-05";
        $activity12->distance = 9500;
        $activity12->moving_time = 3300;
        $activity12->user_name = "Anna Wilson";
        $activity12->save();
    }
}
