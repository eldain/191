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
use App\MyFacebookApi;
use App\MyTwitterApi;
use App\MyInstagramApi;


Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/login', function() {
  return View('login');
});

// Custom API's below
// Facebook
// Example: http://homestead.app/fbReactionsPerPost/GigaSavvy/5
Route::get('/fbReactionsPerPost/{user?}/{post_count?}',
  function($user = 'GigaSavvy', $post_count = 5) {
  $fb = new MyFacebookApi();
  return $fb->getNumberOfReactionsPerPost($user, $post_count);
});

Route::get('/fbCommentsPerPost/{user?}/{post_count?}',
  function($user = 'GigaSavvy', $post_count = 5) {
  $fb = new MyFacebookApi();
  return $fb->getNumberOfCommentsPerPost($user , $post_count);
});

Route::get('/fbPageLikeCount/{user?}', function($user = 'GigaSavvy')
{
  $fb = new MyFacebookApi();
  return $fb->getPageLikeCount($user);
});

//Twitter
Route::get('/twLastRetweetCount/{user?}', function($user = 'Gigasavvy')
{
  $twitter = new MyTwitterApi();
  return $twitter->getLastRetweetCount($user);
});

Route::get('/twFollowersCount/{user?}', function($user = 'Gigasavvy')
{
  $twitter = new MyTwitterApi();
  return $twitter->getFollowersCount($user);
});

Route::get('/twFollowersByDay/{user?}', function($user = 'Gigasavvy')
{
  $twitter = new MyTwitterApi();
  return $twitter->getFollowersData($user);
});

Route::get('/twLastTweet/{user?}', function($user = 'Gigasavvy')
{
  $twitter = new MyTwitterApi();
  return $twitter->getLastTweet($user);
});

//Instagram
Route::get('/InstaNumberOffFollowers/{user?}', function($user = '220678271')
{
  $instagram = new MyInstagramApi();
  return $instagram->getNumberOfFollowers($user);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
