<?php

namespace App\Http\Controllers;

use App\Community;
use App\Event;
use App\User;
use App\Venue;
use Carbon\Carbon;
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

        } elseif ($user->hasRole('community-admin')) {
            $userId = $user->id;

            $communityManagedCount = Community::where('user_id', $userId)->count();

            $eventManagedCount = Event::where('user_id', $userId)->count();

            $widget = array(
                "communityCount" => $communityCount,
                "eventCount" => $eventCount,
                "communityManagedCount" => $communityManagedCount,
                "eventManagedCount" => $eventManagedCount,
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


    public function chart()
    {
        $user = Auth::user();

        $response = array();

        if ($user->hasRole('super-admin'))  {
            $i = 0;
            while ($i < 7) {
                $dateOfWeekBefore = Carbon::now()->subDays($i + 1);
                $dateOfWeek = Carbon::now()->subDays($i);
                $eventsForThisDay = User::whereBetween('created_at', [$dateOfWeekBefore, $dateOfWeek]);
                $response[$dateOfWeek->toDateString()] = $eventsForThisDay->count();
                $i++;
            }
        } else {
            $i = 0;
            while ($i < 7) {
                $dateOfWeekBefore = Carbon::now()->subDays($i + 1);
                $dateOfWeek = Carbon::now()->subDays($i);
                $eventsForThisDay = Event::whereBetween('created_at', [$dateOfWeekBefore, $dateOfWeek]);
                $response[$dateOfWeek->toDateString()] = $eventsForThisDay->count();
                $i++;
            }
        }

        return response()->json($response);
    }
}
