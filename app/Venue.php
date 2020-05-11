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
        'name', 'description', 'capacity', 'air_conditioned', 'active', 'venue_image_path',
    ];

    /**
     * Get the events for the venue.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * Get the name acronym for the venue.
     */
    public function getNameAcronymAttribute()
    {
        $words = preg_split("/\s+/", $this->name);
        $acronym = "";

        $i = 0;
        foreach ($words as $w) {
            if ($i == 3) break;
            $acronym .= strtoupper($w[0]);
            $i++;
        }
        return $acronym;
    }

    /**
     * Get the usage rate for the venue.
     */
    public function getUsageRateAttribute()
    {
        $eventCount = Event::count();
        if ($eventCount == 0) return 0;
        return ($this->events->count() / $eventCount) * 100;
    }
}
