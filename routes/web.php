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

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/users/destroy/many/{ids}', 'UserController@destroyMany')->name('users.destroyMany');
Route::resource('users', 'UserController');;

Route::resource('communities','CommunityController');

