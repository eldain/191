<?php

namespace App;


class MyInstagramApi 
{

    private $access_token = '220678271.feac92c.647e2f561b594603b48a4696dfbbc3bf';
    private $instagramHost = 'https://api.instagram.com/v1/';
    

    public function getInstaIdByUsername($user) {
        $search_url = $this->instagramHost . 'users/search?q=' . $user 
            . '&access_token=' . $this->access_token; 

        $ch = curl_init($search_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = '';
        if (($json = curl_exec($ch) ) === false){
            throw new \Exception('Curl error: ' . curl_error($ch));
        } else {
            $json_output = json_decode($json);
            if(isset($json_output->meta->error_type) || $json_output->data == []) {
                throw new \Exception($json);
            } else {
                $insta_id = "None";
                foreach ($json_output->data as $result){
                    if ($result->username == $user){
                        $insta_id = $result->id;
                        break;
                    }
                }
                if ($insta_id == "None"){
                    throw new \Exception($json);
                }
                return $insta_id;
            }
        }
    }

    /**
     * Get most all post until the specified until date
     * https://api.instagram.com/v1/users/{user-id}/media/
     * recent/?access_token=ACCESS-TOKEN
     *
     * @return String
     */
    public function getRecentPosts($user, $until) {
        $insta_id = $this->getInstaIdByUsername($user);

        $until_date = new \DateTime($until);
        $date;
        $data_array = [];
        $next_call = [];
        do {
            $json_url = $this->instagramHost . 'users/' . $insta_id 
                . '/media/recent/?count=100&access_token=' . $this->access_token;

            if (!empty((array) $next_call)) {
                return "here";
                $json_url = $next_call;
            }

            $ch = curl_init($json_url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = '';
            if (($json = curl_exec($ch) ) === false){
                throw new \Exception('Curl error: ' . curl_error($ch));
            } else {
                $json_output = json_decode($json);
                if(isset($json_output->meta->error_type) || $json_output->data == []) {
                    throw new \Exception($json);
                } else {
                    $next_call = $json_output->pagination;
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
                        $data_to_add->likes = $post->likes->count;
                        $date = new \DateTime();
                        $date->setTimestamp($post->created_time);
                        $data_to_add->time = $date->getTimestamp();
                        if ($date < $until_date){
                            break;
                        } else {
                            array_push($data_array, $data_to_add);
                        }
                    }
                }
            } 
        } while ($date > $until_date && !empty((array) $next_call));
        return json_encode($data_array);
    }

    /**
     * the number of followers.
     *
     * @return String
     */
    public function getNumberOfFollowers($user) {
        $insta_id = $this->getInstaIdByUsername($user);

        $json_url = $this->instagramHost . 'users/' . $insta_id 
                    . '/?access_token=' . $this->access_token;

        $ch = curl_init($json_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = '';
        if (($json = curl_exec($ch) ) === false){
            throw new \Exception('Curl error: ' . curl_error($ch));
        } else {
            $json_output = json_decode($json);
            if(isset($json_output->meta->error_type) || $json_output->data == []) {
                throw new \Exception($json);
            } else {
                return $json_output->data->counts->followed_by; 
            }
        }
    }

}
