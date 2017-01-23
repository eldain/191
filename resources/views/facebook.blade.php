@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content gold">
		<?php
			use App\MyFacebookApi;
			$fb = new MyFacebookApi();
			echo '<h3>GigaSavvy number of likes = ' . $fb->getPageLikeCount('GigaSavvy') . '</h3>';
		    echo '<h3> Number of Reactions per post: ' . $fb->getNumberOfReactionsPerPost('GigaSavvy', 5) . '</h3>';
		    echo '<h3> Number of Comments per post: ' . $fb->getNumberOfCommentsPerPost('GigaSavvy', 5) . '</h3>';
		?>

		<svg viewBox="0 0 500 100" class="chart">
		  <polyline
		     fill="none"
		     stroke="#0074d9"
		     stroke-width="2"
		     points="
		       00,120
		       20,60
		       40,80
		       60,20
		       80,80
		       100,80
		       120,60
		       140,100
		       160,90
		       180,80
		       200, 110
		       220, 10
		       240, 70
		       260, 100
		       280, 100
		       300, 40
		       320, 0
		       340, 100
		       360, 100
		       380, 120
		       400, 60
		       420, 70
		       440, 80
		     "
		   />
		</svg>

	</div>

	<style media="screen">
	.chart {
		width: 500px;
		height: 100px;
		padding: 20px 20px;
		border: 1px solid gold;
	}
	</style>
</main>

@stop
