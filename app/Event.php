<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Get the community that owns the event.
     */
    public function community()
    {
        return $this->belongsTo('App\Community');
    }

    /**
     * Get the members of the events.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the venue of the events.
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    /**
     * Get the user that posted the event.
     */
    public function user()
    {
        return $this->belongsTo('App\User');

    }
}
