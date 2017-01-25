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
        //TODO: test when null check fails
        if(\Auth::check() && \Auth::user()->facebook != null) {
            $user = \Auth::user()->facebook;
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfReactionsPerPost($user, $post_count);
        } else {
            return 'not logged in';
        }
  
    }

    /**
     * Get Facebook comments per post.
     * @return Response
     */
    public function getCommentsPerPost(Request $request)
    {
        if(\Auth::check() && \Auth::user()->facebook != null) {
            $user = \Auth::user()->facebook;
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfCommentsPerPost($user, $post_count);
        } else {
            return 'not logged in';
        }
    }

    /**
     * Get number of likes on Facebook Page.
     * @return Response
     */
    public function getPageLikeCount(Request $request)
    {
        if(\Auth::check() && \Auth::user()->facebook != null) {
            $user = \Auth::user()->facebook;
            $fb = new MyFacebookApi();
            return $fb->getPageLikeCount($user);
        } else {
            return 'not logged in';
        }
    }
}