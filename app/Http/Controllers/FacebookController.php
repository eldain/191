<?php

namespace App\Http\Controllers;

use App\MyFacebookApi;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    /**
     * Get Facebook reactions per post.
     * @return Response
     */
    public function getReactionsPer(Request $request)
    {
        if (!\Auth::check()){
            return 'not logged in';
        } else if (\Auth::user()->facebook == 'null') {
            return 'facebook username not set';
        } else {
            $user = \Auth::user()->facebook;
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfReactionsPerPost($user, $post_count);
        }
  
    }

    /**
     * Get Facebook comments per post.
     * @return Response
     */
    public function getCommentsPerPost(Request $request)
    {
        if (!\Auth::check()){
            return 'not logged in';
        } else if (\Auth::user()->facebook == 'null') {
            return 'facebook username not set';
        } else {
            $user = \Auth::user()->facebook;
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfCommentsPerPost($user, $post_count);
        }
    }

    /**
     * Get number of likes on Facebook Page.
     * @return Response
     */
    public function getPageLikeCount(Request $request)
    {
        if (!\Auth::check()){
            return 'not logged in';
        } else if (\Auth::user()->facebook == 'null') {
            return 'facebook username not set';
        } else {
            $user = \Auth::user()->facebook;
            $fb = new MyFacebookApi();
            return $fb->getPageLikeCount($user);;
        }
    }
}