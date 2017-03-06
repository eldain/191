<?php

namespace App;


class MyFacebookApi 
{
    private $appid; // Luke's = 1675423156013517
    private $appsecret; // Luke's = e336cc48fe592916c5968024714d7a89
    private $FbGraphHost = 'https://graph.facebook.com/';

    function __construct($appid, $appsecret) {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
    }

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
        . $this->appid . '|' . $this->appsecret;

        $ch = curl_init($json_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = '';
        if (($json = curl_exec($ch) ) === false){
            throw new \Exception('Curl error: ' . curl_error($ch));
        } else {
            $json_output = json_decode($json);
            if(isset($json_output->error)){
                throw new \Exception($json);
            } else {
                        //Extract the likes count from the JSON object
                if($json_output->fan_count){
                    return $likes = $json_output->fan_count;
                }else{
                    return 0;
                }
            }
        }  
    }

    /**
     * Get a number of reactions and comments per post, with post times
     * 
     * URL Called: https://graph.facebook.com/{$pageId}/
     * posts/?fields=permalink_url,shares,message,updated_time,
     * reactions.summary(total_count),comments.summary(total_count)
     * &since=06/01/2016&until=08/01/2016
     * &limit=100&offset=0
     * &access_token={$appid}|{$appsecret}
     *
     * @return String in JSON format
     */
    public function getFeedDataInDateRange($pageId, $since, $until)
    {
        $limit = 30;
        $offset = 0;
        
        $data_array = [];
        do{
            //Construct a Facebook URL
            $json_url = $this->FbGraphHost . $pageId 
            . '/posts/?fields=permalink_url,shares,message,updated_time,reactions.summary(total_count),comments.summary(total_count)&since=' 
            . $since . '&until='. $until 
            . '&limit='. $limit . '&offset=' . $offset 
            . '&access_token=' . $this->appid.'|'.$this->appsecret;

            // old file_get_contents code
            // $json = file_get_contents($json_url);
            // $json_output = json_decode($json);

            $ch = curl_init($json_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = '';
            if (($json = curl_exec($ch) ) === false) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            } else {
                $json_output = json_decode($json);
                if(isset($json_output->error)){
                    throw new \Exception($json);
                } else {
                    foreach ($json_output->data as $post){
                        $data_to_add = new \stdClass();
                        if(isset($post->message) && ($post->message!=null)){
                            $data_to_add->message = $post->message;
                        } else {
                            $data_to_add->message = "";
                        }
                        if(isset($post->shares) && ($post->shares!=null)){
                            $data_to_add->shares_count = $post->shares->count;
                        } else {
                            $data_to_add->shares_count = 0;
                        }
                        $data_to_add->url = $post->permalink_url;
                        $data_to_add->time = $post->updated_time;
                        $data_to_add->reactions = $post->reactions->summary->total_count;
                        $data_to_add->comments = $post->comments->summary->total_count;
                        array_push($data_array, $data_to_add);
                    }
                    // Change the data offset each time to keep getting data till
                    // we reach the end.
                    $offset += 30;
                }    
            }
        } while($json_output->data != [] );

        return json_encode($data_array);

    }

}
