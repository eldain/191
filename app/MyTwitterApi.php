<?php

namespace App;

use TwitterAPIExchange;

class MyTwitterApi 
{
    private $settings = array(
        'oauth_access_token' => "4775133980-wGivgWH5O91qrdoo9oBVJio4uwUgfQ9baSk2U6s",
        'oauth_access_token_secret' => "Gq3MBg5I7erXfQbYOTGD8G7VugaeVMTwecpuO1X3tvcdk",
        'consumer_key' => "HqSjdxilaF7ogzd6ldpbS6DoA",
        'consumer_secret' => "xRsiyK1v7aylulNDVPqUxrBFBWq3tDqjkIfGfcPbkXnSUmQVj0");
    private $twitter;

    function __construct() {
       $this->twitter = new TwitterAPIExchange($this->settings);
    }

    /**
     * Get most recent tweet text
     *
     * @return String
     */
    public function getLastTweet($twitterUserName)
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $twitterUserName . '&count=1';
        $requestMethod = 'GET';

        $response = $this->twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();


        $json_a=json_decode($response,true);
        $tweet = $json_a[0]['text'];
        return $tweet;
    }

    /**
     * Get most recent tweet retweet count
     *
     * @return String
     */
    public function getLastRetweetCount($twitterUserName)
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $twitterUserName . '&count=1';
        $requestMethod = 'GET';

        $response = $this->twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();


        $json_a=json_decode($response,true);
        $retweets = $json_a[0]['retweet_count'];
        return $retweets;
    }

    /**
     * Get the number of followers for a user
     *
     * @return String
     */
    public function getFollowersCount($twitterUserName)
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $twitterUserName . '&count=1';
        $requestMethod = 'GET';

        $response = $this->twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();


        $json_a=json_decode($response,true);
        $retweets = $json_a[0]['user']['followers_count'];
        return $retweets;
    }

}
