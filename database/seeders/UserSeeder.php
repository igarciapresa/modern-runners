<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->id_strava = 1;
        $user->first_name = "Peter";
        $user->last_name = "Jones";
        $user->access_token = "asdasdasd";
        $user->refresh_token = "asdasdasd";
        $user->email = "pj@pj.pj";
        $user->points = 2200;
        $user->gold_medals = 1;
        $user->silver_medals = 3;
        $user->bronze_medals = 3;
        $user->role = "manager";
        $user->why_run = "I run because it's my passion and I truly enjoy it";
        $user->save();

        $user2 = new User();
        $user2->id_strava = 2;
        $user2->first_name = "Jamie";
        $user2->last_name = "Petterson";
        $user2->access_token = "asdasdasd";
        $user2->refresh_token = "asdasdasd";
        $user2->email = "jp@jp.jp";
        $user2->points = 2700;
        $user2->gold_medals = 2;
        $user2->silver_medals = 2;
        $user2->bronze_medals = 1;
        $user2->why_run = "I run because I want to get fit having fun";
        $user2->save();

        $user3 = new User();
        $user3->id_strava = 3;
        $user3->first_name = "Rachel";
        $user3->last_name = "Washington";
        $user3->access_token = "asdasdasd";
        $user3->refresh_token = "asdasdasd";
        $user3->email = "rw@rw.rw";
        $user3->points = 1500;
        $user3->gold_medals = 1;
        $user3->silver_medals = 1;
        $user3->bronze_medals = 2;
        $user3->role = "manager";
        $user3->why_run = "I've always loved running because my parents are also runners";
        $user3->save();

        $user4 = new User();
        $user4->id_strava = 4;
        $user4->first_name = "Michael";
        $user4->last_name = "Francis";
        $user4->access_token = "asdasdasd";
        $user4->refresh_token = "asdasdasd";
        $user4->email = "mf@mf.mf";
        $user4->points = 1000;
        $user4->gold_medals = 1;
        $user4->silver_medals = 0;
        $user4->bronze_medals = 0;
        $user4->role = "runner";
        $user4->why_run = "I've always loved running because my parents are also runners";
        $user4->save();

        $user5 = new User();
        $user5->id_strava = 5;
        $user5->first_name = "Anna";
        $user5->last_name = "Wilson";
        $user5->access_token = "asdasdasd";
        $user5->refresh_token = "asdasdasd";
        $user5->email = "aw@aw.aw";
        $user5->points = 4000;
        $user5->gold_medals = 3;
        $user5->silver_medals = 2;
        $user5->bronze_medals = 4;
        $user5->role = "runner";
        $user5->why_run = "I run because I want to get fit having fun";
        $user5->save();
    }
}