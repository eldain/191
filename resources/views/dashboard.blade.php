@extends('dashboard-template')

@section('dashboard-title', 'Dashboard')
@section('dashboard-body')
<main class="mdl-layout__content content-background flex">
	<div class="card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2">
		<div class="white ma3 f2">Facebook</div>
		<div class="white f3 ma3 mt4"><i class="material-icons txt-gold pr3">favorite</i>45 Reactions</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i>78 Comments</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">visibility</i>270 Views</div>
		<a class="link txt-gold ma3 pointer" href="/facebook">Across 16 posts</a>
	</div>
	<div class="card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2 flex flex-column content-around">
		<div class="white ma3 f2">Twitter</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i>45 Favorites</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i>78 Retweets</div>
		<a class="link txt-gold ma3 pointer" href="/twitter">Across 16 tweets</a>
	</div>
	<div class="card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2 flex flex-column content-around">
		<div class="white ma3 f2">Instagram</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i>45 Likes</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i>78 Comments</div>
		<a class="link txt-gold ma3 pointer" href="/instagram">Across 16 posts</a>
	</div>
</main>

<!-- Keeping for reference, will delete once new cards are created -Daniel (Monday, February 13, 2017 @ 15:32) -->
<!-- <main class="mdl-layout__content content-background">

	<div class="mdl-grid demo-content">

		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand card-background">
					<h2 class="mdl-card__title-text">Facebook Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
						use App\MyFacebookApi;
						$fb = new MyFacebookApi();
						echo( 'CocaCola number of likes =' .$fb->getPageLikeCount('cocacola'));
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/facebook" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>


		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand card-background">
					<h2 class="mdl-card__title-text">Instagram Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
						use App\MyInstagramApi;
                		$instagram = new MyInstagramApi();
                		echo 'theguitarrevolution has ' . $instagram->getNumberOfFollowers('theguitarrevolution') . ' followers.';
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/instagram" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>


		<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">

			<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
				<div class="mdl-card__title mdl-card--expand card-background">
					<h2 class="mdl-card__title-text">Twitter Updates</h2>
				</div>
				<div class="mdl-card__supporting-text mdl-color-text--grey-600">
					<?php
						use App\MyTwitterApi;
						$twitter = new MyTwitterApi();
						echo $twitter->getLastTweet('Gigasavvy');
					?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/twitter" class="mdl-button mdl-js-button mdl-js-ripple-effect">More Details</a>
				</div>
			</div>
		</div>

	</div>
</main> -->
@stop
