<?php

namespace App\Http\Controllers;

use App\MyInstagramApi;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    /**
     * Get the most recent tweet text
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
            // $post_count = $request->input('tweet_count', 5);
            $instagram = new MyInstagramApi();
            return $instagram->getNumberOfFollowers($user);
        }
    }
}