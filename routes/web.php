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
Route::get('/event/{id}', 'EventController@show')->name('event.show');
Route::post('/ajax/unmarkedNotification', function(Request $request)
{
    $user = App\User::where('id', Auth::user()->id)->first();
    $user->unreadNotifications->markAsRead();
//    auth()->user()->unreadNotifications->where('id', $request->get('id'))->markAsRead();

    return response()->json(['status' => 1, $request->get('id')], 200);
})->name('notification.ajax.unmarked');
Route::post('/ajax/replyRequest', function(Request $request)
{
    $da = auth()->user()->notifications()->where('id', $request->get('id'))->get()->map(function($item) use($request)
    {
        $aw = new stdClass();
        $aw->data = 'Your request to join '. $item->data['group']. ' has been '.$request->get('answer').'.';
        $aw->group = $item->data['group'];
        $aw->request = $item->data['request'];
        $aw->action = 2;
        $aw->routing = $item->data['routing'];
        $aw->routingID = $item->data['routingID'];
        $aw->permit = $request->get('answer') == 'accept' ? 1 : 0;
        $item->data = ($aw);
        return $item;
    });
    auth()->user()->notifications()->where('id', $request->get('id'))->update(['data' => $da[0]->data]);
    return response()->json(['status' => 1, $request->get('id'), $request->get('answer')], 200);
})->name('notification.ajax.reply');


Route::post('/ajax/latestNotification', function(Request $request)
{
   return response()->json(['status' => 1, 'data' => auth()->user()->notifications()->latest()->first()], 200);
})->name('notification.ajax.latest');


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
//    $da = auth()->user()->notifications()->latest()->first();
//    print_r(json_encode($da));
//    $communities = \App\Community::where('id', 1)->first();
//
//        echo $communities->users;
        $event = Event::where('id', 28)->first();
        echo $event->community->name;
});

Route::get('/testCommunity', function()
{
    echo Auth::user()->student_id;
    echo Auth::user()->roles->first->name->name;
//        event(new \App\Events\CommunityNotification('yoyohoooo', 'computer-science-society'));
});

Route::get('/sendRequestFromStudent', function() // request to join community or event .. search for the id either event id or community id that user wants to join.
{
   $community = \App\Community::where('id', 1)->first();
   echo $community->admin->student_id;
//    $user = \App\User::where('id', auth()->user()->id)->first();
    $communityA = new stdClass();
    $communityA->message = "Trevor requested to join the community ; Computer Science Society";
    $communityA->request = 1;
    $communityA->action = 1; // 0 -> no action given 1 -> action given 2 -> action performed
    $communityA->routing = 'user'; // user and commi
    $communityA->routingID = '1';
    $communityA->group = 'Machine Learning Society';
    $communityA->permit = 0; // to view the notification redirect
    Notification::send($community->admin, new PeopleNotification($communityA));
    event(new \App\Events\StudentNotification($communityA->message, $community->admin->student_id)); // push notification after disapprove or approve to the specific student.


});

Route::get('/notificationFromAdmin', function() // i m the community admin of the ID 2, i will send the notifications to all who are the members of this community
{
    event(new \App\Events\StudentNotification('A community request  sent from Trevor', '9057573')); // push notification after disapprove or approve to the specific student.
//    event(new \App\Events\CommunityNotification('Approval Good', 'computer-science-society'));
    $user = \App\User::where('id', auth()->user()->id)->first();
    $community = new stdClass();
    $community->message = "Trevor requested to join the community ; Computer Science Society";
    $community->request = 1;
    $community->action = 1; // 0 -> no action given 1 -> action given 2 -> action performed
    $community->routing = 'user'; // user and commi
    $community->routingID = '1';
    $community->group = 'Machine Learning Society';
    $community->permit = 0; // to view the notification redirect
    Notification::send($user, new PeopleNotification($community));
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
    $community->message = "Trevor requested to join the community ; Machine Learning Society";
    $community->request = 1;
    $community->action = 1; // 0 -> no action given 1 -> action given 2 -> action performed
    $community->routing = 'commi'; // user and commi
    $community->routingID = '1';
    $community->group = 'Machine Learning Society';
    $community->permit = 0; // to view the notification redirect
    Notification::send($user, new PeopleNotification($community));
//    $user->notify(new PeopleNotification($community));



});
