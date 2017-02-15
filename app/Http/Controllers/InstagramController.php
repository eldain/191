<?php

namespace App\Http\Controllers;

use App\MyInstagramApi;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    /**
     * Get the number of current follwers for username
     * Example url: /inGetNumberOfFollowers?user={username}
     * @return Response
     */
    public function getNumberOfFollowers(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'instagram username not set';
        } else {
            $instagram = new MyInstagramApi();
            return $instagram->getNumberOfFollowers($user);
        }
    }

    /**
     * Get the most recent posts.
     * Example url: /inGetRecentPosts?user={username}
     * @return Response
     */
    public function getRecentPosts(Request $request)
    {
        $user = $request->input('user', 'not_logged_in');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'instagram username not set';
        } else {
            $instagram = new MyInstagramApi();
            return $instagram->getRecentPosts($user);
        }
    }
}