<?php

namespace App;


class MyFacebookApi 
{
    private $appid = '1675423156013517';
    private $appsecret = 'e336cc48fe592916c5968024714d7a89';
    private $FbGraphHost = 'https://graph.facebook.com/';


    /**
     * Get the number of likes on a Facebook page given the page ID.
     *
     * URL Called: https://graph.facebook.com/{$pageId}/?fields=fan_count&
     * access_token={$appid}|{$appsecret}
     *
     * @return String EX: 100
     */
    public function getPageLikeCount($pageId)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId . '/?fields=fan_count&access_token=' 
        . $this->appid.'|'.$this->appsecret;

        $json = file_get_contents($json_url);
        $json_output = json_decode($json);

        //Extract the likes count from the JSON object
        if($json_output->fan_count){
            return $likes = $json_output->fan_count;
        }else{
            return 0;
        }

    }

    /**
     * Get a number of reactions and comments per post, with post times
     * 
     * URL Called: https://graph.facebook.com/{$pageId}/
     * posts/?fields=message,updated_time,
     * reactions.summary(total_count),comments.summary(total_count)
     * &since=06/01/2016&until=08/01/2016
     * &limit=100&offset=0
     * &access_token={$appid}|{$appsecret}
     *
     * @return String in JSON format
     */
    public function getFeedDataInDateRange($pageId, $since, $until, $limit, $offset)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId 
        . '/posts/?fields=message,updated_time,reactions.summary(total_count),comments.summary(total_count)&since=' 
        . $since . '&until='. $until 
        . '&limit='. $limit . '&offset=' . $offset 
        . '&access_token=' . $this->appid.'|'.$this->appsecret;

        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        $data_array = [];
        if($json_output->data){
            foreach ($json_output->data as $post){
                $data_to_add = new \stdClass();
                if(isset($post->message) && ($post->message!=null)){
                    $data_to_add->message = $post->message;
                } else {
                    $data_to_add->message = "";
                }
                $data_to_add->time = $post->updated_time;
                $data_to_add->reactions = $post->reactions->summary->total_count;
                $data_to_add->comments = $post->comments->summary->total_count;
                array_push($data_array, $data_to_add);
            }
        }

        return json_encode($data_array);

    }

    /**
     * Get a number of reactions and comments per post, with post times
     * 
     * URL Called: https://graph.facebook.com/{$pageId}/
     * posts/?fields=message,updated_time,reactions.summary(total_count),
     * comments.summary(total_count)&limit={$limit}&access_token={$appid}|{$appsecret}
     *
     * @return String in JSON format
     */
    public function getFeedData($pageId, $limit)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId 
        . '/posts/?fields=message,updated_time,reactions.summary(total_count),comments.summary(total_count)&limit='
        . $limit . '&access_token=' . $this->appid.'|'.$this->appsecret;

        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        $data_array = [];
        if($json_output->data){
            foreach ($json_output->data as $post){
                $data_to_add = new \stdClass();
                $data_to_add->message = $post->message;
                $data_to_add->time = $post->updated_time;
                $data_to_add->reactions = $post->reactions->summary->total_count;
                $data_to_add->comments = $post->comments->summary->total_count;
                array_push($data_array, $data_to_add);
            }
        }

        return json_encode($data_array);

    }

    /**
     * Get a list of reaction per post in order of most recent.
     *
     * URL Called: https://graph.facebook.com/{$pageId}/
     * feed/?fields=reactions.summary(total_count)&limit=2&
     * access_token={$appid}|{$appsecret}
     *
     * @return String EX: 0,2,3,4
     */
    public function getNumberOfReactionsPerPost($pageId, $limit)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId . '/feed/?fields=reactions.summary(total_count)&limit=' 
        . $limit . '&access_token=' . $this->appid.'|'.$this->appsecret;

        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        $total_reactions_array = [];
        if($json_output->data){

            foreach ($json_output->data as $post){
                $reaction_count = $post->reactions->summary->total_count;
                array_push($total_reactions_array, $reaction_count);
            }

        }
        return implode(",", $total_reactions_array);

    }

    /**
     * Get a list of comments per post in order of most recent.
     *
     * URL Called: https://graph.facebook.com/{$pageId}/
     * feed/?fields=comments.summary(total_count)&limit=2&
     * access_token={$appid}|{$appsecret}
     *
     * @return String EX: 0,2,3,4
     */
    public function getNumberOfCommentsPerPost($pageId, $limit)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId . '/feed/?fields=comments.summary(total_count)&limit=' 
        . $limit . '&access_token=' . $this->appid.'|'.$this->appsecret;

        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        $total_comments_array = [];
        if($json_output->data){

            foreach ($json_output->data as $post){
                $comments_count = $post->comments->summary->total_count;
                array_push($total_comments_array, $comments_count);
            }

        }
        return implode(",", $total_comments_array);

    }

}
