<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// For Login
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Facebook
Route::get('/fbReactionsPerPost', 'FacebookController@getReactionsPer');
Route::get('/fbCommentsPerPost', 'FacebookController@getCommentsPerPost');
Route::get('/fbPageLikeCount', 'FacebookController@getPageLikeCount');
Route::get('/fbGetFeedData', 'FacebookController@getFeedData');
Route::get('/fbGetFeedDateRange', 'FacebookController@getFeedDateRange');

// Twitter
Route::get('/twGetLastTweet', 'TwitterController@getLastTweet');
Route::get('/twGetLastRetweetCount', 'TwitterController@getLastRetweetCount');
Route::get('/twGetFollowersCount', 'TwitterController@getFollowersCount');
Route::get('/twGetFollowersData', 'TwitterController@getFollowersData');

// Instagram
Route::get('/inGetNumberOfFollowers', 'InstagramController@getNumberOfFollowers');

// Update user
Route::post('updateUserGeneral', 'UserController@updateGeneralSettings')->middleware('auth');
Route::post('updateUserAPI', 'UserController@updateAPISettings')->middleware('auth');

/* (lukeraus) test URL below */
Route::get('/test', function () {
	$results = DB::select('select * from users', array(1));
    return $results;
})->middleware('auth');

Route::get('/greeting', function()
{
	$user = DB::table('users')->where('name', 'luke')->first();
  return View::make('greeting', array('name' => $user->name));
})->middleware('auth');

Route::get('/dashboard', function() {
  return View('dashboard');
})->middleware('auth');

Route::get('/settings', function() {
	return View('settings');
})->middleware('auth');

Route::get('/facebook', function() {
  return View('facebook');
})->middleware('auth');

Route::get('/instagram', function() {
  return View('instagram');
})->middleware('auth');

Route::get('/twitter', function() {
  return View('twitter');
})->middleware('auth');
