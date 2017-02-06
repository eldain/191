<?php

namespace App\Http\Controllers;

use App\MyTwitterApi;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
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
            // $post_count = $request->input('tweet_count', 5);
            $twitter = new MyTwitterApi();
            return $twitter->getLastTweet($user);
        }
  
    }
}