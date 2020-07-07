<?php

use App\Event;
use App\Events\CommunityNotification;
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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');;

Route::get('ajax/home/chart','HomeController@chart')->name('ajax.home.chart');

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
Route::post('/ajax/public/communities', 'CommunityController@ajaxIndexPublic')->name('ajax.public.communities.index');
Route::delete('/communities/destroy/many/{ids}', 'CommunityController@destroyMany')->name('communities.destroyMany');
Route::post('/communities/join/{community}', 'CommunityController@join')->name('communities.join');;
Route::resource('communities', 'CommunityController');

Route::get('/commi/{id}','CommunityController@communityPage')->name('commi.community');
Route::get('/commi/{community}/members', 'CommunityController@communityMembers')->name('commi.members');
Route::get('/commi/{id}/past', 'CommunityController@pastEventList')->name('commi.past.event');
Route::post('/ajax/updateCom', 'CommunityController@aJaxUpdateCom')->name('commi.ajax.update.community');
Route::post('/ajax/deleteEvent', 'EventController@ajaxDeleteEvent')->name('event.ajax.delete');
Route::post('/ajax/updateEvent', 'EventController@ajaxUpdateEvent')->name('event.ajax.update');
Route::post('/ajax/createEvent', 'EventController@ajaxCreateEvent')->name('event.ajax.create');
Route::post('/event/join/{event}', 'EventController@join')->name('event.join');
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
    $da = auth()->user()->notifications()->where('id', $request->get('id'))->get();

    $user = \App\User::where('id', $da[0]->data['routingID'])->first();
    $targetedID = $da[0]->data['type0'] == 'event' ? Event::where('id', $da[0]->data['groupID'])->first() : \App\Community::where('id', $da[0]->data['groupID'])->first();

    // create new notification object
    $aw = new stdClass();
    $aw->message = 'Your request to join '. $da[0]->data['group']. ' has been '.$request->get('answer').'.';
    $aw->request = 0; //$item->data['request'];
    $aw->action = 0; //2;
    $aw->routing = $da[0]->data['type0'] == 'event' ? 'event' : 'commi';
    $aw->routingID = $targetedID->id;
    $aw->group = $da[0]->data['group'];
    $aw->groupID = $da[0]->data['groupID'];
    $aw->type0 = $da[0]->data['type0'];
    $aw->permit = $request->get('answer') == 'accept' ? 1 : 0;

    $targetedID->users()->sync($user);
    //send the notification to the user based on the notification object and student's details ; channel via student id
    event(new \App\Events\StudentNotification($aw->message, $user->student_id)); // push notification after disapprove or approve to the specific student.
    Notification::send($user, new PeopleNotification($aw));
    // delete the notification,
    auth()->user()->notifications()->where('id', $request->get('id'))->delete(); // delete the request as performed the action; accept or reject
    $targetedID->users()->sync($user);


    return response()->json(['status' => 1, $request->get('id'), $request->get('answer'), $user, $aw], 200);
})->name('notification.ajax.reply');


Route::post('/ajax/latestNotification', function(Request $request)
{
   return response()->json(['status' => 1, 'data' => auth()->user()->notifications()->latest()->first()], 200);
})->name('notification.ajax.latest');


Route::get('/testNotification', function()
{
   return view('communityadmin.community.notification');
});

//Route::get('/sendRequestFromStudent', function() // request to join community or event .. search for the id either event id or community id that user wants to join.
//{
//    sendNotification();
//});

//function sendNotification()
//{
//    $community = \App\Event::where('id', 52)->first();
//    $community = \App\Community::where('id', 3)->first();
//    $notification = new stdClass();
//    $notification->message = auth()->user()->name ." requested to join the community ;" . $community->name; // first param ; auth name and second param; community or event name
//    $notification->request = 1; // only request is 1  // otherwise 0
//    $notification->action = 1; // 0 -> no action given 1 -> action given 2 -> action performed
//    $notification->routing = 'user'; // user and commi // if request, put it user otherwise put it, commi.
//    $notification->routingID = auth()->user()->id; // put the userid or community id so that the user can navigate to view page;
//    $notification->group = $community->name; // the community name or event name
//    $notification->groupID = $community->id; // the community name or event name
//    $notification->type0 = 'community'; // the community name or event name
//    $notification->permit = 1; // to view the notification redirect // only permit value be 1 if it is a request, otherwise put it 0
//    Notification::send($community->admin, new PeopleNotification($notification));
//    event(new \App\Events\StudentNotification($notification->message, $community->admin->student_id)); // push notification after disapprove or approve to the specific student.
//}

Route::get('/notificationFromAdmin', function() // i m the community admin of the ID 2, i will send the notifications to all who are the members of this community
{
//    event(new \App\Events\CommunityNotification('Approval Good', 'computer-science-society'));
    $user = \App\User::where('id', 7)->first();
    $community = new stdClass();
    $community->message = "There is a changes to the details and policy of  ; Computer Science Society";
    $community->request = 0;
    $community->action = 0; // 0 -> no action given 1 -> action given 2 -> action performed
    $community->routing = 'user'; // user and commi
    $community->routingID = '1';
    $community->group = 'Machine Learning Society';
    $community->permit = 0; // to view the notification redirect
    Notification::send($user, new PeopleNotification($community));
    event(new \App\Events\StudentNotification('A community request  sent from Trevor', '9057573')); // push notification after disapprove or approve to the specific student.

});

//function string_snake_case($string)
//{
//
//    return str_replace(" ", "-", strtolower($string));
//}

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

Route::get('/debugMode', function()
{
//        $event = Event::where('id', 51)->first();
//        $event->users()->sync(auth()->user());
        $community = \App\Community::where('id', 2)->first();
        $community->users()->sync(auth()->user());
});
