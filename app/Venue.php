<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capacity', 'air_conditioned', 'venue_image_path',
    ];

    /**
     * Get the events for the venue.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
