<?php

namespace App\Http\Controllers;

use App\MyTwitterApi;
use Illuminate\Http\Request;

class TwitterController extends Controller
{

    /**
     * Get the most recent tweets
     * Example url: /twGetTweets?user={username}
     * @return Response
     */
    public function getTweets(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'twitter username not set';
        } else {
            $until = $request->input('until');
            $twitter = new MyTwitterApi();
            return $twitter->getTweets($user, $until);
        }
    }

    /**
     * Get the most recent tweet text
     * Example url: /twGetLastTweet?user={username}
     * @return Response
     */
    public function getLastTweet(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'twitter username not set';
        } else {
            $twitter = new MyTwitterApi();
            return $twitter->getLastTweet($user);
        }
    }

    /**
     * Get the most recent tweet Retweet count
     * Example url: /twGetLastRetweetCount?user={username}
     * @return Response
     */
    public function getLastRetweetCount(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'twitter username not set';
        } else {
            $twitter = new MyTwitterApi();
            return $twitter->getLastRetweetCount($user);
        }
    }

    /**
     * Get the number of twitter followers
     * Example url: /twGetFollowersCount?user={username}
     * @return Response
     */
    public function getFollowersCount(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'twitter username not set';
        } else {
            $twitter = new MyTwitterApi();
            return $twitter->getFollowersCount($user);
        }
    }

    /**
     * Get the number of twitter followers over a period of time
     * Example url: /twGetFollowersData?user={username}
     * @return Response
     */
    public function getFollowersData(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'twitter username not set';
        } else {
            $twitter = new MyTwitterApi();
            return $twitter->getFollowersData($user);
        }
    }
}