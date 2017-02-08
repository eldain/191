@extends('dashboard-template')

@section('dashboard-title', 'Dashboard')
@section('dashboard-body')
<main class="mdl-layout__content content-background">

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
</main>
@stop
