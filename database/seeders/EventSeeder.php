<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $event = new Event();
        $event->name = "5K May";
        $event->goal = 5;
        $event->start_date = "2021-05-01";
        $event->end_date = "2021-06-01";
        $event->description = "Who is our fastest short distance runner?";
        $event->finished = true;
        $event->save();

        $event1 = new Event();
        $event1->name = "3K May";
        $event1->goal = 3;
        $event1->start_date = "2021-05-01";
        $event1->end_date = "2021-06-01";
        $event1->description = "Who is our fastest ultra-short distance runner?";
        $event1->save();

        $event2 = new Event();
        $event2->name = "7K May-June";
        $event2->goal = 7;
        $event2->start_date = "2021-05-01";
        $event2->end_date = "2021-07-01";
        $event2->description = "Upload your fastest 7K during these two months";
        $event2->save();
    }
}