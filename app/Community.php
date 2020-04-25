<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    /**
     * Get the users of the community.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the events for the community.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * Get the admin of the community.
     */
    public function admin()
    {
        return $this->belongsTo('App\User');
    }
}
