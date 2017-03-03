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
    private $twitterCountApiKey = '8ebb122d7edc916bfde239331263ca68';

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


        $json_a = json_decode($response);
        if(isset($json_a->errors)){
            throw new \Exception($response);
        } else {
            $tweet = $json_a[0]->text;
            return $tweet;
        }
    }

    /**
     * Get most all tweets until the specified until date
     *
     * @return String
     */
    public function getTweets($twitterUserName,  $until)
    {
        $until_date = new \DateTime($until);
        $date;
        $data_array = [];
        $page = 1;
        do {
            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $getfield = '?&screen_name=' . $twitterUserName . '&count=200&page=' . $page;
            $requestMethod = 'GET';

            $response = $this->twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();

            $tweets = json_decode($response);
            if(isset($tweets->errors)){
                throw new \Exception($response);
            } else {
                foreach ($tweets as $post){
                    $data_to_add = new \stdClass();
                    $data_to_add->text = $post->text;
                    $data_to_add->created_at = $post->created_at;
                    $data_to_add->favorite_count = $post->favorite_count;
                    $data_to_add->retweet_count = $post->retweet_count;
                    $date = new \DateTime($data_to_add->created_at);
                    if ($date < $until_date){
                        break;
                    } else {
                        array_push($data_array, $data_to_add);
                    }
                }
            }
            $page += 1;
        } while ($date > $until_date);
        return json_encode($data_array);
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


        $json_a=json_decode($response);
        if(isset($json_a->errors)){
            throw new \Exception($response);
        } else {
            $retweets = $json_a[0]->retweet_count;
            return $retweets;
        }
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


        $json_a = json_decode($response);
        if(isset($json_a->errors)){
            throw new \Exception($response);
        } else {
            $followers_count = $json_a[0]->user->followers_count;
            return $followers_count;
        }
    }

    /**
     * Get the followers data over time
     *
     * @return String
     */
    public function getFollowersData($twitterUserName)
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $twitterUserName . '&count=1';
        $requestMethod = 'GET';

        $response = $this->twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();


        $json_a = json_decode($response);
        if(isset($json_a->errors)){
            throw new \Exception($response);
        } else {
            $twitter_id = $json_a[0]->user->id_str;
            $twitter_count_url = 'http://api.twittercounter.com/?twitter_id=' 
            . $twitter_id . '&apikey=' . $this->twitterCountApiKey;
            
            $json_twitter_count = json_decode(file_get_contents($twitter_count_url));
            $followersperdate_array = $json_twitter_count->followersperdate;
            return json_encode($followersperdate_array);
        }
    }

}
