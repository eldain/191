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
     * The most recent posts by user.
     * https://api.instagram.com/v1/users/{user-id}/media/
     * recent/?access_token=ACCESS-TOKEN
     *
     * @return String
     */
    public function getRecentPosts($user)
    {
        $insta_id = $this->getInstaIdByUsername($user);
        // TODO: Figure out pagnation
        if ($insta_id != "None"){
            $json_url = $this->instagramHost . 'users/' . $insta_id 
                . '/media/recent/?count=100&access_token=' . $this->access_token;
                $json = file_get_contents($json_url);
                $json_output = json_decode($json);
                $data_array = [];
                if ($json_output->data != []){
                    foreach ($json_output->data as $post){
                        $data_to_add = new \stdClass();
                        if(isset($post->comments) && ($post->comments!=null)){
                            $data_to_add->comments_count = $post->comments->count;
                        } else {
                            $data_to_add->comments_count = 0;
                        }
                        if(isset($post->caption->text) && ($post->caption->text!=null)){
                            $data_to_add->text = $post->caption->text;
                        } else {
                            $data_to_add->text = "";
                        }
                        $data_to_add->time = $post->created_time;
                        $data_to_add->likes = $post->likes->count;
                        array_push($data_array, $data_to_add);
                    }
                }
                return json_encode($data_array);  
        } else {
            return $insta_id;
        }
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
