<?php

use App\Event;
use App\Notifications\PeopleNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');;

Route::get('/profile', 'ProfileController@show')->name('profiles.show');;
Route::get('/profile/edit', 'ProfileController@edit')->name('profiles.edit');;
Route::put('/profile', 'ProfileController@update')->name('profiles.update');;

Route::post('files/images', 'FileImageController@store')->name('files.images.store');
Route::delete('files/images', 'FileImageController@destroy')->name('files.images.destroy');

Route::post('/ajax/users/search', 'UserController@ajaxSearch')->name('ajax.users.search');
Route::post('/ajax/users', 'UserController@ajaxIndex')->name('ajax.users.index');
Route::delete('/users/destroy/many/{ids}', 'UserController@destroyMany')->name('users.destroyMany');
Route::resource('users', 'UserController');;

Route::post('/ajax/venues/search', 'VenueController@ajaxSearch')->name('ajax.venues.search');
Route::post('/ajax/venues', 'VenueController@ajaxIndex')->name('ajax.venues.index');
Route::delete('/venues/destroy/many/{ids}', 'VenueController@destroyMany')->name('venues.destroyMany');
Route::resource('venues', 'VenueController');;

Route::post('/ajax/communities', 'CommunityController@ajaxIndex')->name('ajax.communities.index');
Route::delete('/communities/destroy/many/{ids}', 'CommunityController@destroyMany')->name('communities.destroyMany');
Route::resource('communities', 'CommunityController');

Route::get('/commi/{id}','CommunityController@communityPage')->name('commi.community');
Route::get('/commi/{id}/past', 'CommunityController@pastEventList')->name('commi.past.event');
Route::post('/ajax/updateCom', 'CommunityController@aJaxUpdateCom')->name('commi.ajax.update.community');
Route::post('/ajax/deleteEvent', 'EventController@ajaxDeleteEvent')->name('event.ajax.delete');
Route::post('/ajax/updateEvent', 'EventController@ajaxUpdateEvent')->name('event.ajax.update');
Route::post('/ajax/createEvent', 'EventController@ajaxCreateEvent')->name('event.ajax.create');
Route::post('/ajax/unmarkedNotification', function(Request $request)
{
    $user = App\User::where('id', Auth::user()->id)->first();
    $user->unreadNotifications->markAsRead();

    return response()->json(['status' => 1,], 200);
})->name('notification.ajax.unmarked');
Route::get('/testNotification', function()
{
   return view('communityadmin.community.notification');
});
Route::get('/eventC', function() // testing
{
    echo Auth::id();
//    $length = 50;
//    $word1 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcedefghiklmnopqrstxyz'),1,$length);
//    $word2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcedefghiklmnopqrstxyz'),1,10);
//    $alpha =  new \App\Event();
//    $alpha->name = $word2;
//    $alpha->description = $word1;
//    $alpha->start_time = date('Y-m-d H:i:s', strtotime(now()));
//    $alpha->end_time = date('Y-m-d H:i:s' ,strtotime("+ 7 day"));
//    $alpha->max_participants = rand(20,50);
//    $alpha->fee = 0.0;
//    $alpha->community_id = 1;
//    $alpha->venue_id = 1;
//    $alpha->user_id = 2;
//    $alpha->image_URL = "";
//    $alpha->created_at = now();
//    echo $alpha;
//    $alpha->save();
//   for($i = 0;$i<15;$i++)
//{
//
//}
});

Route::get('/testEvent', function()
{
//    event(new \App\Events\StudentNotification('A community request', '9057573')); // push notification after disapprove or approve to the specific student.
//    $event = new Event();
//    echo $event->id;
//    echo Carbon::now()->toDateString('Y-m-d');
//    $date = new DateTime(null);
//    $tz = $date->getTimezone();//    $event = Event::where('id', 2)->first();
//    dd($tz);
//    $event->name = 'dd';
//    echo join("" , $event->getDirty('name'));
//        $ymd = Carbon::createFromFormat('Y-m-d H:i:s', '2020-07-04 18:45:00');
//        echo $ymd;
//
////        return response()->json([$ymd], 200);
//        $da = Carbon::createFromFormat('Y-m-d H:i:s', '2020-07-04 19:45:00')->subSeconds(1);
//        $sDate = Carbon::createFromFormat('Y-m-d', substr($ymd, 0, 10));
//        $formatted = $sDate->year . '-'. ($sDate->month < 10 ? '0'. $sDate->month: $sDate->month) . '-'. $sDate->day;
//    echo Event::where('venue_id', 2)
//        ->whereBetween('start_time', [$ymd, $da])
//        ->where('end_time' , '>=', $ymd)
//        ->where('start_time', 'like', $formatted.'%')->where('end_time', 'like', $formatted. '%')->where('active', 1)
//        ->exists() ? "true" : "false";
//   $event = Event::where('venue_id', 1)->where('id', '!=' , '5')
//       ->whereBetween('start_time', [$ymd, $da])
//       ->where('end_time' , '>=', $ymd)
//       ->where('start_time', 'like', $formatted.'%')->where('end_time', 'like', $formatted. '%')
//       ->exists() ? "true" :"false";
//   echo $event;
//   foreach($event as $events)
//   {
//       echo $events;
//   }
});

Route::get('/testCommunity', function()
{
    echo Auth::user()->student_id;
    echo Auth::user()->roles->first->name->name;
//        event(new \App\Events\CommunityNotification('yoyohoooo', 'computer-science-society'));
});

Route::get('/sendRequestFromStudent', function() // request to join community or event .. search for the id either event id or community id that user wants to join.
{
   $community = \App\Community::where('id', 2)->first();
   echo $community->admin->student_id;
    event(new \App\Events\StudentNotification('A community request  sent from Trevor', $community->admin->student_id)); // push notification after disapprove or approve to the specific student.

});

Route::get('/notificationFromAdmin', function() // i m the community admin of the ID 2, i will send the notifications to all who are the members of this community
{

    // setup the channels subscription for the non-admin. example ; students who joined  the community
//    $students = \App\User::where('id', 4)->first();
//    $student_channels = array_map(function($string)
//    {
//        return str_replace(" ", "-", strtolower($string));
//    }, array_column(json_decode($students->communities, true), 'name'));
//    print_r($student_channels);

    // admin channels.
//    $communities = \App\Community::where('user_id', 2)->get();
//    $community_channels = array_map(function($string)
//    {
//        return str_replace(" ", "-", strtolower($string));
//    }, array_column(json_decode($communities, true), 'name'));
//
//    print_r($community_channels);
    event(new \App\Events\StudentNotification('A community request  sent from Trevor', '9057573')); // push notification after disapprove or approve to the specific student.

    event(new \App\Events\CommunityNotification('Approval Good', 'computer-science-society'));
});

function string_snake_case($string)
{

    return str_replace(" ", "-", strtolower($string));
}

//Route::get('/changeDetails', function()
//{
////    $event = Event::where('id', 28)->first();
////
////   $user= App\User::where('id', 6)->first();
////   $user->name = 'dsadsa';
////   $user->password = Hash::make('123456');
////   echo join(", ", $user->getChanges());
////   $user->save();
//
//    $event = Event::all();
//    foreach ($event as $events)
//    {
//        do
//        {
//            $uuid1 = substr(Uuid::uuid1(), 0 ,10);
//            $eventTag= Event::where('eventTag', $uuid1)->first();
//        }
//        while(!empty($eventTag));
//        $events->eventTag= $uuid1;
//        $events->save();
//
//    }
//
//});

function generate_random_tag()
{
    do
    {
        $uuid1 = substr(Uuid::uuid1(), 0 ,10);
        $eventTag= Event::where('eventTag', $uuid1)->first();
    }
    while(!empty($user_code));
    echo $uuid1;
}

Route::get('/testN', function()
{
    $user = App\User::all();
    $community = new stdClass();
    $community->message = "Machine Learning Society has just organized a new event.";
    $community->request = 1;
    $community->action = 1; // 0 -> no action given 1 -> action given 2 -> action performed
    Notification::send($user, new PeopleNotification($community));
//    $user->notify(new PeopleNotification($community));

});
