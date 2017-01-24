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
Route::get('/fbReactionsPerPost', function()
{
  $fb = new MyFacebookApi();
  return $fb->getNumberOfReactionsPerPost('GigaSavvy', 5);
});

Route::get('/fbCommentsPerPost', function()
{
  $fb = new MyFacebookApi();
  return $fb->getNumberOfCommentsPerPost('GigaSavvy', 5);
});

Route::get('/fbPageLikeCount', function()
{
  $fb = new MyFacebookApi();
  return $fb->getPageLikeCount('GigaSavvy');
});

//Twitter
Route::get('/twLastRetweetCount', function()
{
  $twitter = new MyTwitterApi();
  return $twitter->getLastRetweetCount('Gigasavvy');
});

Route::get('/twFollowersCount', function()
{
  $twitter = new MyTwitterApi();
  return $twitter->getFollowersCount('Gigasavvy');
});

Route::get('/twFollowersByDay', function()
{
  $twitter = new MyTwitterApi();
  return $twitter->getFollowersData('Gigasavvy');
});

Route::get('/twLastTweet', function()
{
  $twitter = new MyTwitterApi();
  return $twitter->getLastTweet('Gigasavvy');
});

//Instagram
Route::get('/InstaNumberOffFollowers', function()
{
  $instagram = new MyInstagramApi();
  return $instagram->getNumberOfFollowers('220678271');
});
