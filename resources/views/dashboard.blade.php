@extends('dashboard-template')

@section('dashboard-title', 'Observation Deck')
@section('dashboard-body')
<main class="mdl-layout__content mdl-color--grey-100">

	<div class="mdl-grid demo-content">

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--green-500">
					<h2 class="mdl-card__title-text">Instagram Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
			        $access_token = '220678271.feac92c.647e2f561b594603b48a4696dfbbc3bf';
			        $json_url = "https://api.instagram.com/v1/users/220678271/?access_token=" . $access_token;
			        $json = file_get_contents($json_url);
			        $json_output = json_decode($json);
			        echo "theguitarrevolution has " . $json_output->data->counts->followed_by . " followers";
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/instagram" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--blue-500">
					<h2 class="mdl-card__title-text">Facebook Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
					// TODO CREATE A FB CLASS
			        $appid = '1675423156013517';
			        $appsecret = 'e336cc48fe592916c5968024714d7a89';
			      
					//Get Facebook Likes Count of a page
					// https://graph.facebook.com/cocacola/?fields=fan_count&access_token=1675423156013517|e336cc48fe592916c5968024714d7a89
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
					echo( 'CocaCola number of likes =' .fbLikeCount('cocacola',$appid, $appsecret));
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/facebook" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--yellow-600">
					<h2 class="mdl-card__title-text">Twitter Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
					// TODO CREATE A TWITTER CLASS
					$settings = array(
									'oauth_access_token' => "4775133980-wGivgWH5O91qrdoo9oBVJio4uwUgfQ9baSk2U6s",
									'oauth_access_token_secret' => "Gq3MBg5I7erXfQbYOTGD8G7VugaeVMTwecpuO1X3tvcdk",
									'consumer_key' => "HqSjdxilaF7ogzd6ldpbS6DoA",
									'consumer_secret' => "xRsiyK1v7aylulNDVPqUxrBFBWq3tDqjkIfGfcPbkXnSUmQVj0"
									);
							$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
							$getfield = '?screen_name=Gigasavvy&count=1';
							$requestMethod = 'GET';

							$twitter = new TwitterAPIExchange($settings);
							$response = $twitter->setGetfield($getfield)
									->buildOauth($url, $requestMethod)
									->performRequest();


							$json_a=json_decode($response,true);
							$tweet = $json_a[0]['text'];
							echo $tweet;
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/twitter" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--teal-500">
					<h2 class="mdl-card__title-text">Google Analytics Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
					echo "Google Analytics";
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--red-200">
					<h2 class="mdl-card__title-text">Magento Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
					echo "Megento Stats";
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

	</div>
</main>
@stop
