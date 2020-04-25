<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /**
     * Get the events for the venue.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
