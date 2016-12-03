@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<?php
	        $appid = '1675423156013517';
	        $appsecret = 'e336cc48fe592916c5968024714d7a89';
	      
			//Get Facebook Likes Count of a page
			//https://graph.facebook.com/cocacola/?fields=fan_count&access_token=1675423156013517|e336cc48fe592916c5968024714d7a89
			function fbLikeCount($id,$appid,$appsecret){
				//Construct a Facebook URL
				$json_url ='https://graph.facebook.com/'.$id.'/?fields=fan_count&access_token='.$appid.'|'.$appsecret;
				$json = file_get_contents($json_url);
				$json_output = json_decode($json);

				//Extract the likes count from the JSON object
				if($json_output->fan_count){
					return $likes = $json_output->fan_count;
				}else{
					return 0;
				}
			}
			//This Will return like count of CoffeeCupWeb Facebook page
			// access_token=1675423156013517|e336cc48fe592916c5968024714d7a89
			echo '<h3>GigaSavvy number of likes = ' . fbLikeCount('GigaSavvy',$appid, $appsecret) . '</h3>';
		?>
	</div>
</main>

@stop
