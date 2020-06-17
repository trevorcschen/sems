<?php

use Illuminate\Support\Facades\Route;

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
Route::delete('/communities/destroy/many/{ids}', 'CommunityController@destroyMany')->name('communities.destroyMany');
Route::resource('communities', 'CommunityController');

Route::get('/commi/{id}','CommunityController@communityPage')->name('commi.community');
Route::get('/eventC', function() // testing
{
    $length = 50;
    $word1 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcedefghiklmnopqrstxyz'),1,$length);
    $word2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcedefghiklmnopqrstxyz'),1,10);
    $alpha =  new \App\Event();
    $alpha->name = $word2;
    $alpha->description = $word1;
    $alpha->start_time = date('Y-m-d H:i:s', strtotime(now()));
    $alpha->end_time = date('Y-m-d H:i:s' ,strtotime("+ 7 day"));
    $alpha->max_participants = rand(20,50);
    $alpha->fee = 0.0;
    $alpha->community_id = 1;
    $alpha->venue_id = 1;
    $alpha->user_id = 2;
    $alpha->image_URL = "";
    $alpha->created_at = now();
    echo $alpha;
    $alpha->save();
//   for($i = 0;$i<15;$i++)
//{
//
//}
});
