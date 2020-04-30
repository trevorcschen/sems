<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'student_id', 'ic_number', 'phone_number', 'password', 'email_verified_at',
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

    public function AdminCommunities()
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
}
