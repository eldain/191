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

Route::get('/', function () {
    return view('welcome');
});

/* (lukeraus) test URL below */
Route::get('/test', function () {
	$results = DB::select('select name from users', array(1));
    return $results;
});

Route::get('/greeting', function()
{
	$user = DB::table('users')->where('name', 'luke')->first();
    return View::make('greeting', array('name' => $user->name));
});

Route::get('/graph', function () {
    return View('graph');
});

Route::get('/graph2', function () {
    return View('graph2');
});