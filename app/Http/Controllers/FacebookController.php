<?php

namespace App\Http\Controllers;

use App\MyFacebookApi;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    /**
     * Get Facebook reactions per post.
     * Example url: /fbReactionsPerPost?user={username}&post_count=10
     * @return Response
     */
    public function getReactionsPer(Request $request)
    {
        $user = $request->input('user', 'null');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'facebook username not set';
        } else {
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfReactionsPerPost($user, $post_count);
        }
  
    }

    /**
     * Get Facebook reactions per post.
     * Example url: /fbGetFeedData?user={username}&post_count=10
     * @return Response
     */
    public function getFeedData(Request $request)
    {
        $user = $request->input('user', 'null');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'facebook username not set';
        } else {
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getFeedData($user, $post_count);
        }
  
    }

    /**
     * Get Facebook comments per post.
     * Example url: /fbCommentsPerPost?user={username}&post_count=10
     * @return Response
     */
    public function getCommentsPerPost(Request $request)
    {
        $user = $request->input('user', 'null');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'facebook username not set';
        } else {
            $post_count = $request->input('post_count', 5);
            $fb = new MyFacebookApi();
            return $fb->getNumberOfCommentsPerPost($user, $post_count);
        }
    }

    /**
     * Get number of likes on Facebook Page.
     * Example url: /fbPageLikeCount?user={username}
     * @return Response
     */
    public function getPageLikeCount(Request $request)
    {
        $user = $request->input('user', 'null');
        if ($user == 'not_logged_in'){
            return 'not logged in';
        } else if ($user == 'null') {
            return 'facebook username not set';
        } else {
            $fb = new MyFacebookApi();
            return $fb->getPageLikeCount($user);;
        }
    }
}