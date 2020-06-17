<?php

namespace App\Http\Controllers;

use App\Community;
use App\Event;
use App\User;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $communityCount = Community::count();
        $eventCount = Event::count();

        if ($user->hasRole('super-admin')) {
            $userCount = User::count();
            $venueCount = Venue::count();

            $widget = array(
                "userCount"  => $userCount,
                "communityCount" => $communityCount,
                "eventCount" => $eventCount,
                "venueCount" => $venueCount,
            );

        } else {
            $userId = $user->id;

            $communityJoinedCount = Community::whereHas('users', function($q) use($userId) {
                $q->where('users.id', $userId);
            })->count();

            $eventJoinedCount = Event::whereHas('users', function($q) use($userId) {
                $q->where('users.id', $userId);
            })->count();

            $widget = array(
                "communityCount" => $communityCount,
                "eventCount" => $eventCount,
                "communityJoinedCount" => $communityJoinedCount,
                "eventJoinedCount" => $eventJoinedCount,
            );
        }

        return view('home', compact('widget'));
    }
}
