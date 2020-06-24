<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    //
    public function ajaxDeleteEvent(Request $request)
    {
        $event = Event::where('id', $request->get('id'))->first();
        $event->active = 0;
        $event->update();
        Session::flash('message', "Event Tag of ".$event->name . " has been cancelled due to specific reasons");
        return response()->json(['isDelte' => true , $request->get('id')], 200);
    }
}
