<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fee', 'max_members', 'logo_path', 'active', 'user_id',
    ];

    /**
     * Get the admin of the community.
     */
    public function admin()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

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
     * Get the membership rate of the community.
     */
    public function getMembershipRateAttribute()
    {
        if ($this->max_members == 0) return 0;
        return ($this->users->count() / $this->max_members) * 100;
    }
}
