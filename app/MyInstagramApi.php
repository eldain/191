<?php

namespace App;


class MyInstagramApi 
{

    private $access_token = '220678271.feac92c.647e2f561b594603b48a4696dfbbc3bf';
    private $instagramHost = 'https://api.instagram.com/v1/';

    public function getInstaIdByUsername($user)
    {
        $search_url = $this->instagramHost . 'users/search?q=' . $user 
            . '&access_token=' . $this->access_token; 

        $json_search = json_decode(file_get_contents($search_url));
        $insta_id = "None";
        if($json_search->data){
            foreach ($json_search->data as $result){
                if ($result->username == $user){
                    $insta_id = $result->id;
                    break;
                }
            }
        }
        return $insta_id;
    }

    /**
     * the number of followers.
     *
     * @return String
     */
    public function getNumberOfFollowers($user)
    {
        $insta_id = $this->getInstaIdByUsername($user);

        if ($insta_id != "None"){
            $json_url = $this->instagramHost . 'users/' . $insta_id 
                . '/?access_token=' . $this->access_token;
                $json = file_get_contents($json_url);
                $json_output = json_decode($json);
                return $json_output->data->counts->followed_by;  
        } else {
            return $insta_id;
        }
    }

}
