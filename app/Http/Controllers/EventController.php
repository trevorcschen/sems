<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

                return response()->json(['status'=> '1', 'messaged' => 'changed on Image' . $msgP, 'isDirty' => 'true'], 200);

            }
            else
            {
                $event->image_URL = $newFileName;
                $event->update();
                Session::flash('message', "Customization on Event Details worked perfectly; Image changed !!.");

                return response()->json(['status'=> '1', 'messaged' => 'changed on Image ' . $msgP, 'isDirty' => 'false'], 200);
            }
        }
        else
        {
            if($event->isDirty())
            {
                $event->update();
                Session::flash('message', "Customization on Event Details worked perfectly; Columns :  !!.");
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
//
        if($request->get('isNewImage') == "true")
        {
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
            return response()->json(['status'=> '1', $ymd, $da,  $formatted, $request->get('startDate')], 200);
        }
//        return response()->json(['status' => 1,'message' => 'No crashing timeslot', 'errorFound' => false, $event], 200);
    }
}
