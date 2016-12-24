@extends('dashboard-template')
@section('title', 'Twitter Updates')

@section('dashboard-title', 'Twitter Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<h3>Twitter Info goes on this Page</h3>
		<?php
			use App\MyTwitterApi;
			$twitter = new MyTwitterApi();
			echo '<h4>GigaSavvy tweet = ' . $twitter->getTweet('Gigasavvy') . '</h4>';
			echo '<h4>GigaSavvy retweet = ' . $twitter->getRetweetCount('Gigasavvy') . '</h4>';
		?>
	</div>
</main>

@stop
