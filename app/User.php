<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'student_id', 'ic_number', 'phone_number', 'biography', 'profile_image_path', 'password', 'active', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the communities managed by the user.
     */
    public function communitiesManaged()
    {
        return $this->hasMany('App\Community');
    }

    /**
     * The communities that the user joined.
     */
    public function communities()
    {
        return $this->belongsToMany('App\Community');
    }

    /**
     * Get the events joined by the users.
     */
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    /**
     * Get the events managed by the user.
     */
    public function eventsManaged()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * Get the name acronym for the user.
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
     * Get the events joined percentage of the user.
     */
    public function getActiveRateAttribute()
    {
        $eventCount = Event::count();
        if ($eventCount == 0) return 0;
        return ($this->events->count() / $eventCount) * 100;
    }
}
