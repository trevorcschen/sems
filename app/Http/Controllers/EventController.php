<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\CommunityNotification;
use App\Notifications\PeopleNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use stdClass;

class EventController extends Controller
{
    //
    public function show($eventID)
    {
        $event = Event::where('id', $eventID)->first();
        $event->current_participants = $event->users->count();
        $event->percentage = round($event->current_participants / $event->max_participants * 100, 0);
        $isCommunity = false;

//        echo auth()->user()->events()->name;
        foreach (auth()->user()->communities as $community)
        {
            if($community->id == $event->community->id)
            {
                $isCommunity = true;
            }
        }
        if($event->community->user_id == auth()->user()->id)
        {
            $isCommunity = true;
        }

        if($isCommunity)
        {
            return view('communityadmin.event.show', compact('event', 'event'));
        }
        else
        {
            return response()->view('errors.404', [], 404);
        }

    }


    public function ajaxDeleteEvent(Request $request)
    {
        $event = Event::where('id', $request->get('id'))->first();
        $event->active = 0;
//        $event->update();
        Session::flash('message', "Event ".$event->name . " has been cancelled due to specific reasons");
        $channelDescription = 'The Moderator ('.$event->community->name.') has just deleted the event <b>'. $event->name. '</b>';
        $this->sendNotification($event, $channelDescription);
//        event(new \App\Events\CommunityNotification('The Moderator has just deleted the event of <b>'. $event->name. '</b>', str_replace(" ", "-", strtolower($event->community->name))));
        return response()->json(['isDelte' => true , $request->get('id')], 200);
    }

    public function ajaxUpdateEvent(Request $request)
    {
        $event = Event::where('id' , $request->get('id'))->first();
        $event->description = $request->get('description');
        $event->name = $request->get('name');
        $event->venue_id =  $request->get('venueID');
        $event->start_time = $request->get('startDate');
        $event->end_time = $request->get("endDate");
        $msgP = "";
        if($event->isDirty('start_time') || $event->isDirty('end_time'))
        {
            $ymd = Carbon::createFromFormat('Y-m-d H:i:s', $request->get('startDate'));
            $da = Carbon::createFromFormat('Y-m-d H:i:s', $request->get('endDate'))->subSeconds(1);
            $sDate = Carbon::createFromFormat('Y-m-d', substr($ymd, 0, 10));
            $formatted = $sDate->year . '-'. ($sDate->month < 10 ? '0'. $sDate->month: $sDate->month) . '-'. $sDate->day;
               $eventA = Event::where('venue_id', $event->venue_id)->where('id', '!=' , $event->id)
               ->whereBetween('start_time', [$ymd, $da])
               ->where('end_time' , '>=', $ymd)
               ->where('start_time', 'like', $formatted.'%')->where('end_time', 'like', $formatted. '%')->where('active', 1)
               ->exists() ? "true" : "false";
               if($eventA == "true")
               {
                   return response()->json(['status' => "1", 'message' => 'Please select other venue or time', 'errorFound' => true], 200);
               }
               $msgP .= "There is no same date or venue selected";
//            return response()->json(['status' => "1", 'message' => 'updated successfully '], 200);
        }
        else
        {
            $event->isDirty() ? $msgP .= " Dirty Found" : $msgP .= "nothing changed";
        }
        if($request->get('isNewImage') == "true")
        {
            $base64_image = $request->get('base64URL');
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $type) = explode('/', $type);
            @list(, $file_data) = explode(',', $file_data);
            $newFileName = mt_rand().time() . '.' . $type;
            Storage::put('images/event/'. $request->get('id').'/'.$newFileName, base64_decode($file_data)); // store img locally

            if($event->isDirty())
            {
                $event->image_URL = $newFileName;
                $event->update();
                Session::flash('message', "Customization on Event Details worked perfectly; Image changed and other columns !!.");
                $channelDescription ='The Moderator ('.$event->community->name.') has just updated the event image and event details of <b>'. $event->name. '</b>';
                $this->sendNotification($event, $channelDescription);
//                event(new \App\Events\CommunityNotification('The Moderator has just updated the event image and event details of <b>'. $event->eventTag. '</b>', str_replace(" ", "-", strtolower($event->community->name))));
                return response()->json(['status'=> '1', 'messaged' => 'changed on Image' . $msgP, 'isDirty' => 'true'], 200);

            }
            else
            {
                $event->image_URL = $newFileName;
                $event->update();
                Session::flash('message', "Customization on Event Details worked perfectly; Image changed !!.");
                $channelDescription ='The Moderator ('.$event->community->name.') has just updated the event logo of <b>'. $event->name. '</b>';
                $this->sendNotification($event, $channelDescription);
//                event(new \App\Events\CommunityNotification('The Moderator has just updated the event logo of <b>'. $event->eventTag. '</b>', str_replace(" ", "-", strtolower($event->community->name))));
                return response()->json(['status'=> '1', 'messaged' => 'changed on Image ' . $msgP, 'isDirty' => 'false'], 200);
            }
        }
        else
        {
            if($event->isDirty())
            {
                $event->update();
                Session::flash('message', "Customization on Event Details worked perfectly!!.");
//                event(new \App\Events\CommunityNotification('The Moderator has just updated the event details of <b>'. $event->eventTag. '</b>', str_replace(" ", "-", strtolower($event->community->name))));
                $channelDescription = 'The Moderator ('.$event->community->name.') has just updated the event details of <b>'. $event->name. '</b>';
                $this->sendNotification($event, $channelDescription);
                return response()->json(['status'=> '1', 'messaged' => 'received no image '. $msgP, 'isDirty' => 'true', 'axa' =>$event->getDirty()], 200);
            }
            else
            {
                return response()->json(['status'=> '0', 'messaged' => 'received but nothing else changed', ], 200);

            }
        }
    }

    public function ajaxCreateEvent(Request $request)
    {
        $event = new Event();
        $event->description = $request->get('description');
        $event->name = $request->get('name');
        $event->venue_id =  $request->get('venueID');
        $event->start_time = $request->get('startDate');
        $event->end_time = $request->get("endDate");
        $event->max_participants = $request->get('max_participants');
        $event->fee = number_format($request->get('fees'), 2);
        $event->community_id = $request->get('communityID');
        $event->user_id = Auth::id();
        do
        {
            $uuid1 = substr(Uuid::uuid1(), 0 ,10);
            $eventTag= Event::where('eventTag', $uuid1)->first();
        }        while(!empty($eventTag));
        $event->eventTag = $uuid1;
        $ymd = Carbon::createFromFormat('Y-m-d H:i', $request->get('startDate'));
        $da = Carbon::createFromFormat('Y-m-d H:i', $request->get('endDate'))->subSeconds(1);
        $sDate = Carbon::createFromFormat('Y-m-d', substr($ymd, 0, 10));
        $formatted = $sDate->year . '-'. ($sDate->month < 10 ? '0'. $sDate->month: $sDate->month) . '-'. ($sDate->day < 10 ? '0'. $sDate->day: $sDate->day);
        if(Event::where('venue_id', $event->venue_id)
            ->whereBetween('start_time', [$ymd, $da])
            ->where('end_time' , '>=', $ymd)
            ->where('start_time', 'like', $formatted.'%')->where('end_time', 'like', $formatted. '%')->where('active', 1)
            ->exists())
        {
                return response()->json(['status' => "1", 'message' => 'Please select other venue or time', 'errorFound' => true], 200);
        }
            $base64_image = $request->get('base64URL');
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $type) = explode('/', $type);
            @list(, $file_data) = explode(',', $file_data);
            $newFileName = mt_rand().time() . '.' . $type;
            $event->image_URL = $newFileName;
            $event->active = 1;
            $event->updated_at = now();
            $event->save();
            Storage::put('images/event/'.$newFileName, base64_decode($file_data)); // store img locally
            Session::flash('message', "Added a new event !!.");
            $channelDescription = 'The Moderator ('. $event->community->name.') has just organized a new event ; <b>'. $event->name . '</b>, with tag of <b>'.$event->eventTag. '</b> and it is due by <b>' . substr(Carbon::createFromFormat('Y-m-d', substr($ymd, 0, 10))->subDays(1), 0,10) . '</b>';
            $this->sendNotification($event, $channelDescription);
            return response()->json(['status'=> '1', $ymd, $da,  $formatted, $request->get('startDate')], 200);

    }

    public function sendNotification(Event $event, $channelDescription)
    {
        // previously was putting community attributes but now changed to event
        $community = new stdClass();
        $community->message = strip_tags($channelDescription);
        $community->request = 0;
        $community->action = 0; // 0 -> no action given 1 -> action given 2 -> action performed
        $community->routing = 'event'; // user and commi
        $community->routingID = $event->id;
        $community->group = $event->name;
        $community->groupID = $event->id;
        $community->type0 = 'event';
        $community->permit = 1; // to view the notification redirect
        Notification::send($event->community->users, new PeopleNotification($community));
        event(new CommunityNotification($channelDescription, str_replace(" ", "-", strtolower($event->community->name))));
    }

    public function join(Event $event)
    {
        $event->users()->attach(Auth::user()->id);
        return redirect()->route('event.show', $event)->withSuccess('Event <strong>' . $event->name . '</strong> joined successfully.');
    }
}
