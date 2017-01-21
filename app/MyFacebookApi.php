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
     * @return String
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
     * Get a list of reaction per post in order of most recent.
     *
     * URL Called: https://graph.facebook.com/{$pageId}/
     * feed/?fields=reactions.summary(total_count)&limit=2&
     * access_token={$appid}|{$appsecret}
     *
     * @return String
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

}
