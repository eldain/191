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
     * @return String
     */
    public function fbPageLikeCount($pageId)
    {
        //Construct a Facebook URL
        $json_url = $this->FbGraphHost . $pageId . '/?fields=fan_count&access_token=' . $this->appid.'|'.$this->appsecret;
        $json = file_get_contents($json_url);
        $json_output = json_decode($json);

        //Extract the likes count from the JSON object
        if($json_output->fan_count){
            return $likes = $json_output->fan_count;
        }else{
            return 0;
        }

    }

}
