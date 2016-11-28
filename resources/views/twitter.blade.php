@extends('dashboard-template')
@section('title', 'Twitter Updates')

@section('dashboard-title', 'Twitter Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<h3>Twitter Info goes on this Page</h3>
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
</main>

@stop
