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

// Import Custom Classes
use App\MyTwitterApi;
use App\MyInstagramApi;


// For Login
Auth::routes();

Route::get('/', 'HomeController@index');
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

/* (lukeraus) test URL below */
Route::get('/test', function () {
	$results = DB::select('select * from users', array(1));
    return $results;
});

Route::get('/greeting', function()
{
	$user = DB::table('users')->where('name', 'luke')->first();
  return View::make('greeting', array('name' => $user->name));
});

Route::get('/dashboard', function() {
  return View('dashboard');
});

Route::get('/settings', function() {
  return View('settings');
});

Route::get('/facebook', function() {
  return View('facebook');
});

Route::get('/instagram', function() {
  return View('instagram');
});

Route::get('/twitter', function() {
  return View('twitter');
});

//Instagram
Route::get('/InstaNumberOffFollowers/{user?}', function($user = '220678271')
{
  $instagram = new MyInstagramApi();
  return $instagram->getNumberOfFollowers($user);
});


