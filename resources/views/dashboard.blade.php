@extends('dashboard-template')

@section('dashboard-body')
<main class="mdl-layout__content mdl-color--grey-100">

	<div class="mdl-grid demo-content">

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
					<h2 class="mdl-card__title-text">Twitter Update</h2>
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
					<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>

			<div class="demo-separator mdl-cell--1-col"></div>

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
					<h2 class="mdl-card__title-text">Twitter Update</h2>
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
					<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>

		</div>
	</div>
</main>
@stop
