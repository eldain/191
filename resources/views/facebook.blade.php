@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content gold">
		<!-- <?php
			use App\MyFacebookApi;
			$fb = new MyFacebookApi();
			echo '<h3>GigaSavvy number of likes = ' . $fb->getPageLikeCount('GigaSavvy') . '</h3>';
		    echo '<h3> Number of Reactions per post: ' . $fb->getNumberOfReactionsPerPost('GigaSavvy', 5) . '</h3>';
		    echo '<h3> Number of Comments per post: ' . $fb->getNumberOfCommentsPerPost('GigaSavvy', 5) . '</h3>';
		?> -->
		<div class="mt4 shadow-2" id="chart_div"></div>

	</div>
</main>

@stop
