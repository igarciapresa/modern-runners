<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'strava_activity_id',
        'strava_user_id',
        'event_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    protected $table = 'event_activities';
}
