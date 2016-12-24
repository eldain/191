<?php

namespace App;


class MyInstagramApi 
{

    private $access_token = '220678271.feac92c.647e2f561b594603b48a4696dfbbc3bf';

    /**
     * the number of followers.
     *
     * @return String
     */
    public function getFollowersCount($InstagramUserId)
    {
        $json_url = 'https://api.instagram.com/v1/users/' . $InstagramUserId . '/?access_token=' . $this->access_token;
        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        return $json_output->data->counts->followed_by;
    }

}
